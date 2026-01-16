<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('ligne_devis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('devis_id')->constrained('devis')->onDelete('cascade');
        $table->string('description', 255);
        $table->integer('quantite');
        $table->decimal('prix_unite', 10, 2)->nullable();
        $table->decimal('total', 10, 2)->nullable();
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
        Schema::dropIfExists('ligne_devis');
    }
}
