<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('subtotal',12,0)->nullable()->change();
            $table->decimal('total_amount',12,0)->nullable()->change();
            $table->decimal('tax_amount',12,0)->nullable()->change();
            $table->decimal('remains',12,0)->nullable()->change();
            $table->decimal('amount_paid',12,0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
        });
    }
};
