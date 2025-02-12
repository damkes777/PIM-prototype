<?php

namespace App\Data;

use Exception;
use Illuminate\Support\Collection;
use JsonException;
use Psr\Http\Message\ResponseInterface;

class OpenAIResponse
{
    private const STATUS_CODE_200 = 200;
    private const FAIL_MESSAGE = 'Request fail with status code: ';

    private array $result = [];
    private string $finishReason = '';
    private string $refusal = '';
    private int $statusCode;

    /**
     * @throws JsonException
     */
    public function __construct(
        private readonly ResponseInterface $response
    ) {
        $this->parseResponse();
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    private function parseResponse(): void
    {
        $responseDecoded  = json_decode($this->response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->statusCode = $this->response->getStatusCode();

        if ($this->getStatusCode() !== self::STATUS_CODE_200) {
            throw new Exception(self::FAIL_MESSAGE, $this->getStatusCode());
        }

        $choices            = (collect($responseDecoded['choices']))->first();
        $this->result       = json_decode($choices['message']['content'], true, 512, JSON_THROW_ON_ERROR);
        $this->refusal      = $choices['message']['refusal'] ?? '';
        $this->finishReason = $choices['finish_reason'];
    }

    public function getFinishReason(): string
    {
        return $this->finishReason;
    }

    public function getRefusal(): string
    {
        return $this->refusal;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}