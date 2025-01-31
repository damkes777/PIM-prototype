<?php

$category = \App\Models\Category::query()->first()->pare;
dd($category->english_name);