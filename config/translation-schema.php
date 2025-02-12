<?php

return [
    'type' => 'json_schema',
    'json_schema' => [
        'name' => 'single_word_translation',
        'description' => 'Translated word to a specific language',
        'schema' => [
            'type' => 'object',
            'properties' => [
                'input_word' => [
                    'type' => 'string',
                    'description' => 'The word to be translated',
                ],
                'target_language' => [
                    'type' => 'string',
                    'description' => 'The target language for translation',
                ],
                'translated_word' => [
                    'type' => 'string',
                    'description' => 'The translated word',
                ],
            ],
            'required' => ['input_word', 'target_language', 'translated_word'],
        ],
    ],
];
