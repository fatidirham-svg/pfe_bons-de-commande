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
        Schema::table('bon_commandes', function (Blueprint $table) {
            $table->string('categorie')->nullable();
            $table->string('mode_regelement')->nullable();
            $table->text('observations')->nullable();
            $table->date('date_commande')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('fournisseur_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bon_commandes', function (Blueprint $table) {
            $table->dropColumn(['categorie', 'mode_regelement', 'observations', 'date_commande', 'type']);
            $table->dropForeign(['fournisseur_id']);
            $table->dropColumn('fournisseur_id');
        });
    }
};
