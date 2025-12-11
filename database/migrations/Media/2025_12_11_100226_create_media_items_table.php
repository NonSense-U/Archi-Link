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
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_set_id')->constrained('media_sets')->cascadeOnDelete();
            $table->enum('type', ['image', 'video', 'audio', 'document']);
            $table->integer('index');
            $table->string('url');
            $table->json('metadata')->nullable();
            $table->timestamps();


            $table->unique(['media_set_id', 'index']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};
