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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('annonce_id')->constrained('annonces')->onDelete('cascade'); // Clé étrangère vers la table annonces
            $table->text('content'); // Contenu du message
            $table->boolean('is_read')->default(false); // Indique si le message a été lu
            $table->timestamp('read_at')->nullable(); // Date de lecture du message
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
