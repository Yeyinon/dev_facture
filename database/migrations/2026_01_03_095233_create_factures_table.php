<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('factures', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained('clients');
        $table->foreignId('devis_id')->nullable()->constrained('devis');
        $table->string('num_facture', 10)->unique()->nullable();
        $table->date('issue_date');
        $table->date('due_date')->nullable();
        $table->decimal('subtotal', 10, 2)->nullable();
        $table->decimal('tax', 10, 2)->default(0);
        $table->decimal('total', 10, 2)->nullable();
        $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
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
        Schema::dropIfExists('factures');
    }
}
