<?php

namespace App\Services\OpenAI;

use App\Data\OpenAIResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class OpenAIService
{
    protected string $url;
    protected string $apiKey;
    protected array $headers;
    protected Client $client;

    public function __construct()
    {
        $this->url     = config('openapi-api.url');
        $this->apiKey  = config('openapi-api.api_key');
        $this->headers = [
            'Authorization' => "Bearer $this->apiKey",
            'Content-Type' => 'application/json',
        ];
        $this->client  = new Client(['base_uri' => $this->url]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function executeRequest(
        array $messages,
        array $responseFormat,
        string $model = 'gpt-4o-mini',
    ): OpenAIResponse {
        $response = $this->client->post('', [
            'headers' => $this->headers,
            'json' => [
                'model' => $model,
                'messages' => $messages,
                'response_format' => $responseFormat,
            ],
        ]);

        return new OpenAIResponse($response);
    }
}