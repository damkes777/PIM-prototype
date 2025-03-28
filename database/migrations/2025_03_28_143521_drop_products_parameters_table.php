<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('products_parameters');
    }

    public function down(): void
    {
        Schema::create('products_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();
            $table->foreignId('parameter_id')
                  ->constrained('parameters')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
