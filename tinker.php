<?php

use App\Facades\PriceHelper;

$price = PriceHelper::castToInt('1.234,56'); // 123456
dump($price);

$price = PriceHelper::castToString($price);
dump($price);