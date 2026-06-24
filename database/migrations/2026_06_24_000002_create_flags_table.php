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
        Schema::create('flags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('stories')->onDelete('cascade');
            $table->string('code');
            $table->text('description')->nullable();
            $table->unique(['story_id', 'code']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flags');
    }
};
