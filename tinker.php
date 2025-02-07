<?php

$category = \App\Models\Category::query()->first();
dd($category->names);