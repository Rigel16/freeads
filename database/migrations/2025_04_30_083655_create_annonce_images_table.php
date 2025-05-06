<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('annonce_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('annonce_id')->constrained()->onDelete('cascade'); // Clé étrangère
        $table->string('path'); // Chemin vers l’image stockée
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonce_images');
    }
};
