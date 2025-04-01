<?php

$product = \App\Models\Product::find(1);
$service = app(\App\Services\GenerateServices\GenerateProductDescriptionService::class);

dd($service->generate($product));