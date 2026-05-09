<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_block', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('block_id')->constrained('blocks')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['service_id', 'block_id']);
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_block');
    }
};
