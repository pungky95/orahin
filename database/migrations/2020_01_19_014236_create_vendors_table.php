<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_uid');
            $table->foreign('customer_uid')->references('uid')->on('customers');
            $table->string('name', 250);
            $table->longText('description');
            $table->text('logo');
            $table->text('id_card');
            $table->string('national_identity_number', 250);
            $table->text('id_card_with_customer');
            $table->enum('id_card_verified', ['Verified', 'Unverified', 'Reject'])->default('Unverified');
            $table->string('phone', 16);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
