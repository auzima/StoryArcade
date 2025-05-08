<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('save_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('current_scene'); // ID (string) d’une scène, pas de clé étrangère directe
            $table->json('state'); // état du joueur (flags, scores...)
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('save_games');
    }
};