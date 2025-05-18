<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->foreignId('scene_id')->constrained('scenes')->onDelete('cascade'); // scène d'origine
            $table->string('text');
            $table->foreignId('next_scene_id')->nullable()->constrained('scenes')->onDelete('set null');
            $table->json('effects')->nullable();
            $table->json('conditions')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
