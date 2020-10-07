<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->string('customer_uid', 500);
            $table->foreign('customer_uid')->references('uid')->on('customers');
            $table->enum('status', ['Awaiting Payment', 'Pending', 'Expired', 'Rejected', 'Approved', 'Processed', 'Finished'])->default('Awaiting Payment');
            $table->dateTime('date');
            $table->float('latitude', 40, 10);
            $table->float('longitude', 40, 10);
            $table->text('address');
            $table->string('third_party_payment_transaction_id', 255);
            $table->text('third_party_payment_url');
            $table->json('third_party_payment_json_callback');
            $table->string('third_party_payment_status', 255);
            $table->float('total', 14, 2);
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
