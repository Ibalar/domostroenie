<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->string('main_image')->nullable();
            $table->integer('floors')->default(1);
            $table->decimal('area', 8, 2)->nullable()->comment('Площадь в м²');
            $table->string('implementation_period')->nullable()->comment('Срок реализации');
            $table->string('cost_text')->nullable()->comment('Стоимость строительства (текст)');
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('project_id');
            $table->index('is_published');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};