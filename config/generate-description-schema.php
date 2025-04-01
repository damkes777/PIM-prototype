<?php

return [
    'type' => 'json_schema',
    'json_schema' => [
        'name' => 'product_description',
        'description' => 'Generated product description based on provided details',
        'schema' => [
            'type' => 'object',
            'properties' => [
                'product_name' => [
                    'type' => 'string',
                    'description' => 'The name of the product',
                ],
                'sku' => [
                    'type' => 'string',
                    'description' => 'Stock Keeping Unit (SKU) of the product',
                ],
                'ean' => [
                    'type' => 'string',
                    'description' => 'European Article Number (EAN) of the product',
                ],
                'manufacturer' => [
                    'type' => 'string',
                    'description' => 'The manufacturer of the product',
                ],
                'category' => [
                    'type' => 'string',
                    'description' => 'The category of the product',
                ],
                'parameters' => [
                    'type' => 'object',
                    'description' => 'Technical or specific parameters of the product',
                    'additionalProperties' => [
                        'type' => 'string',
                    ],
                ],
                'generated_description' => [
                    'type' => 'string',
                    'description' => 'AI-generated product description',
                ],
            ],
            'required' => [
                'product_name',
                'sku',
                'ean',
                'manufacturer',
                'category',
                'parameters',
                'generated_description',
            ],
        ],
    ],
];