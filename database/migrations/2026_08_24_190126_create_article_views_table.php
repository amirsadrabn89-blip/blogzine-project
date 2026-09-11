<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_views', function (Blueprint $table) {
            $table->id();

            $table->foreignId('article_id') ->constrained('articles') ->cascadeOnDelete();
            $table->foreignId('user_id') ->nullable() ->constrained('users') ->nullOnDelete();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
            $table->index(['article_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_views');
    }
};
