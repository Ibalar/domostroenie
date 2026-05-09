<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('project_sections');

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['is_portfolio']);
            $table->dropColumn(['is_portfolio', 'implementation_period', 'cost_text']);
        });
    }

    public function down(): void
    {
        Schema::create('project_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->index(['project_id', 'sort_order']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('is_portfolio')->default(false)->after('is_published');
            $table->string('implementation_period')->nullable()->after('is_portfolio');
            $table->string('cost_text')->nullable()->after('implementation_period');
            $table->index('is_portfolio');
        });
    }
};