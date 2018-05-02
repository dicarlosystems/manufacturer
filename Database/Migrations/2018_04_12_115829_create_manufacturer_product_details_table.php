<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturerProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(strtolower('manufacturer_product_details'), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('account_id')->index();
            $table->unsignedInteger('client_id')->index()->nullable();

            $table->string('part_number')->nullable();
			$table->string('ean13')->nullable();
			$table->string('upca')->nullable();
            $table->string('barcode')->nullable();
			$table->unsignedInteger('manufacturer_id')->nullable();
            $table->unsignedInteger('product_id');

            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_deleted')->default(false);

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');

            $table->unsignedInteger('public_id')->index();
            $table->unique( ['account_id', 'public_id'] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(strtolower('manufacturer_product_details'));
    }
}
