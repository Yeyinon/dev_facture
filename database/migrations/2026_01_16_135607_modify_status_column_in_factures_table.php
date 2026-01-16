<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->enum('status', ['draft', 'sent', 'paid'])
                  ->default('draft')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            // Revenir à l'ancien ENUM
            $table->enum('status', ['unpaid', 'paid', 'overdue'])
                  ->default('unpaid')
                  ->change();
        });
    }
};
