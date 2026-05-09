<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_block', function (Blueprint $table) {
            $table->string('title')->nullable()->after('sort_order');
            $table->longText('content')->nullable()->after('title');
            $table->string('image')->nullable()->after('content');
            $table->string('link')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('service_block', function (Blueprint $table) {
            $table->dropColumn(['title', 'content', 'image', 'link']);
        });
    }
};
