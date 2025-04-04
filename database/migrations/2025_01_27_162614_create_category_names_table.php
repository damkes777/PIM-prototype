<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('category_names', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('language', '3');
            $table->string('name');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_names');
    }
};
