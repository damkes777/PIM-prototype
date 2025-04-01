<?php

namespace App\Services\GenerateServices;

use App\Models\Category;
use App\Models\Parameter;
use App\Models\ParameterValue;
use App\Models\Product;
use App\Services\OpenAI\OpenAIService;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class GenerateProductDescriptionService
{
    protected const SYSTEM_CONTENT = 'You are an AI assistant that generates product descriptions based on the information you provide.';
    protected const USER_CONTENT = 'Generate a product description based on the following data:';

    protected Product $product;

    public function __construct(
        protected OpenAIService $openAIService
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function generate(Product $product): string
    {
        $this->product = $product;

        $messages = $this->prepareMessages();
        $schema   = config('generate-description-schema');

        $response = $this->openAIService->executeRequest($messages, $schema);
        $result = $response->getResult();

        return $result['generated_description'];
    }

    protected function prepareParameters(): string
    {
        $parameters = unserialize($this->product->parameters);

        $result = '';
        foreach ($parameters as $parameterId => $valueIds) {
            $parameterName = Parameter::query()
                                      ->find($parameterId)->english_name;
            $valueNames = '';
            foreach ($valueIds as $valueId) {
                $valueName = ParameterValue::query()
                                           ->find($valueId)->english_name;
                $valueNames .= $valueName . ',';
            }
            $result .= "\n- $parameterName: $valueNames";
        }
        return $result;
    }

    protected function prepareCategory(): string
    {
        $category = Category::query()
                            ->find($this->product->id);

        return $category->english_name;
    }

    protected function prepareUserContent(): string
    {
        $name         = $this->product->english_name;
        $sku          = $this->product->sku;
        $ean          = $this->product->ean;
        $manufacturer = $this->product->brand;
        $category     = $this->prepareCategory();
        $parameters   = $this->prepareParameters();


        return self::USER_CONTENT . "\n name: $name\n sku: $sku\n ean: $ean \n manufacturer: $manufacturer \n category: $category \n parameters: $parameters";
    }

    protected function prepareMessages(): array
    {
        return [
            [
                'role' => 'system',
                'content' => self::SYSTEM_CONTENT,
            ],
            [
                'role' => 'user',
                'content' => $this->prepareUserContent(),
            ],
        ];
    }
}