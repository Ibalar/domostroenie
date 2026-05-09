<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('is_portfolio')->default(false)->after('is_published');
            $table->string('implementation_period')->nullable()->after('is_portfolio')->comment('Срок реализации');
            $table->string('cost_text')->nullable()->after('implementation_period')->comment('Стоимость строительства (текст)');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index('is_portfolio');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['is_portfolio']);
            $table->dropColumn(['is_portfolio', 'implementation_period', 'cost_text']);
        });
    }
};