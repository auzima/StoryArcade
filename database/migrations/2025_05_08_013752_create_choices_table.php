<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scene_id')->constrained('scenes')->onDelete('cascade'); // scène d'origine
            $table->string('text');
            $table->string('next_scene'); // ID de la scène cible
            $table->json('effects')->nullable();
            $table->json('conditions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('choices');
    }
};