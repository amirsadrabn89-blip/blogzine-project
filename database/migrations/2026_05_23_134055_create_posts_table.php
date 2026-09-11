<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_code')->unique();
            $table->string('title' , 200)->default('بدون عنوان')->comment('post title');
            $table->string('image')->nullable();
            $table->bigInteger('user_id');
            $table->dateTime('published_at');
            $table->boolean('is_draft')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
