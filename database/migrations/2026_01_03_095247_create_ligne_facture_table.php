<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneFactureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('ligne_facture', function (Blueprint $table) {
        $table->id();
        $table->foreignId('facture_id')->constrained('factures')->onDelete('cascade');
        $table->string('description', 255);
        $table->integer('quantite');
        $table->decimal('prix_unite', 10, 2);
        $table->decimal('total', 10, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_facture');
    }
}
