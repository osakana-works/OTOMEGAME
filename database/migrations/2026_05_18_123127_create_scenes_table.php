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
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('stories')->onDelete('cascade');
            $table->integer('order');

            // 背景2枚
            $table->foreignId('background_id1')
                ->nullable()
                ->constrained('backgrounds')
                ->onDelete('set null');

            $table->foreignId('background_id2')
                ->nullable()
                ->constrained('backgrounds')
                ->onDelete('set null');

            // 吹き出し
            $table->foreignId('balloon_id')
                ->nullable()
                ->constrained('balloons')
                ->onDelete('set null');

            // セリフ
            $table->text('text')->nullable();

            // キャラ画像3枚
            $table->foreignId('character_image1_id')
                ->nullable()
                ->constrained('character_images')
                ->onDelete('set null');

            $table->foreignId('character_image2_id')
                ->nullable()
                ->constrained('character_images')
                ->onDelete('set null');

            $table->foreignId('character_image3_id')
                ->nullable()
                ->constrained('character_images')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenes');
    }
};
