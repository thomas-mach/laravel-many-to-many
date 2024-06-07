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
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // 2. definendo il vincolo di relazione tra le colonne delle tabelle
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');

            // alternativa ai due metodi di sopra
            // $table->foreignId('type_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // 2. rimuovere il vincolo
            $table->dropForeign('projects_type_id_foreign'); // nome del vincolo
            // $table->dropForeign(['category_id']); // nome del vincolo

            // 1. rimuovere la colonna category_id
            $table->dropColumn('type_id');
        });
    }
};
