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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('invoice_no');
            $table->decimal('subtotal',6,0);
            $table->decimal('tax_amount',8,0);
            $table->decimal('total_amount',6,0);
            $table->decimal('amount_paid',8,0);
            $table->decimal('remains',8,0);
            $table->string('status_invoice');
            $table->string('path_qrcode',255);
            $table->foreignId('mode_payment_id')->constrained();
            $table->foreignId('weighbridge_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tractor_id')->constrained();
            $table->foreignId('trailer_id')->constrained();
            $table->foreignId('customer_id')->constrained();
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
        Schema::dropIfExists('invoices');
    }
};
