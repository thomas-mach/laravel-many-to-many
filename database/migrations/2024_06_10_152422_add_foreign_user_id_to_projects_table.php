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
        Schema::table('projects', function (Blueprint $table) {
            // 1. aggiungendo la colonna
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            // 2. definendo il vincolo di relazione tra le colonne delle tabelle
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // alternativa ai due metodi di sopra
            // $table->foreignId('type_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // 2. rimuovere il vincolo
            $table->dropForeign('projects_user_id_foreign'); // nome del vincolo
            // $table->dropForeign(['category_id']); // nome del vincolo

            // 1. rimuovere la colonna category_id
            $table->dropColumn('user_id');
        });
    }
};
