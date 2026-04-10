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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string("type_report");
            $table->string("shift");
            $table->integer("number_incident");
            $table->text("production_comment");
            $table->text("disciplinary_comment");
            $table->text("incidental_comment");
           

            $table->string("attachments")->nullable();

            $table->string("operator_hse_one")->nullable();
            $table->string("operator_hse_two")->nullable();
            $table->string("operator_name_one")->nullable();
            $table->string("operator_name_two")->nullable();

            $table->integer("number_invoice_to_be_billed")->nullable();
            $table->decimal("amount_pay",12,0)->nullable();
            $table->integer("number_cash_invoices")->nullable();
            $table->string("subject")->nullable();
            $table->string("total_number_type_1_weighings")->nullable();
            $table->string("total_number_type_2_weighings")->nullable();
            $table->string("weighbridge")->nullable();

            $table->integer("total_complete_weighing");
            $table->integer("total_complete_weighing_cash");
            $table->integer("total_number_weighings");
            $table->integer("total_complete_weighing_prepaid");
            $table->integer("total_complete_weighing_invoiced");
            $table->integer("total_incomplete_weighing");
            $table->integer("total_incomplete_weighing_cash");
            $table->integer("total_incomplete_weighing_prepaid");
            $table->integer("total_incomplete_weighing_invoiced");
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
        Schema::dropIfExists('reports');
    }
};
