<?php

namespace App\Services\TranslateServices;

use App\Contracts\Translatable;
use App\Services\OpenAI\OpenAIService;
use GuzzleHttp\Exception\GuzzleException;

class TranslateService implements Translatable
{
    private const SYSTEM_PROMPT = 'You translate the given sentence into the following language: ';
    private const USER_PROMPT = 'Translate the sentence: ';

    public function __construct(
        protected OpenAIService $openAIService
    ) {
    }

    /**
     * @throws GuzzleException
     */
    public function translate(string $word, string $targetLanguage): string
    {
        $message = $this->prepareMessage($word, $targetLanguage);
        $schema  = config('translation-schema');

        try {
            $response = $this->openAIService->executeRequest($message, $schema);
            $result   = $response->getResult();

            return $result['translated_sentence'];
        } catch (\Exception $exception) {
            return '';
        }
    }

    protected function prepareMessage(string $word, string $language): array
    {
        return [
            [
                'role' => 'system',
                'content' => self::SYSTEM_PROMPT . $language,
            ],
            [
                'role' => 'user',
                'content' => self::USER_PROMPT . $word,
            ],
        ];
    }
}