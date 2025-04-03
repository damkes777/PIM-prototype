<?php

return [
    'type' => 'json_schema',
    'json_schema' => [
        'name' => 'single_sentence_translation',
        'description' => 'Translated sentence to a specific language',
        'schema' => [
            'type' => 'object',
            'properties' => [
                'input_sentence' => [
                    'type' => 'string',
                    'description' => 'The sentence to be translated',
                ],
                'target_language' => [
                    'type' => 'string',
                    'description' => 'The target language for translation',
                ],
                'translated_sentence' => [
                    'type' => 'string',
                    'description' => 'The translated sentence',
                ],
            ],
            'required' => ['input_sentence', 'target_language', 'translated_sentence'],
        ],
    ],
];
