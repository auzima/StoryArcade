<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scenes', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->integer('order')->default(0);
            $table->string('image')->nullable();
            $table->boolean('is_ending')->default(false);
            $table->json('conditions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scenes');
    }
};
