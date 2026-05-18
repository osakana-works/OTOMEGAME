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
        Schema::create('balloons', function (Blueprint $table) {
            $table->id();

            // 吹き出し名（例：通常 / 叫び / 小声）
            $table->string('name');

            // 吹き出し画像パス
            $table->string('image_path');

            // キャラ専用吹き出しかどうか（null なら全キャラ共通）
            $table->foreignId('character_id')
                ->nullable()
                ->constrained('characters')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balloons');
    }
};
