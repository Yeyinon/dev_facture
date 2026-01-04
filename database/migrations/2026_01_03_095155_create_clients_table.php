<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 25);
        $table->string('email', 30)->nullable();
        $table->string('phone', 15)->nullable();
        $table->string('entreprise', 25)->nullable();
        $table->string('adresse', 25)->nullable();
        $table->timestamps(); // Ajoute created_at et updated_at
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
