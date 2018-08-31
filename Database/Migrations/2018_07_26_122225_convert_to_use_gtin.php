<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertToUseGtin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manufacturer_product_details', function ($table) {
            $table->string('gtin', 14);
        });

        Schema::table('manufacturer_product_details', function ($table) {
            $table->dropColumn('ean13');
            $table->dropColumn('upca');
            $table->dropColumn('barcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manufacturer_product_details', function ($table) {
            $table->string('ean13')->nullable();
            $table->string('upca')->nullable();
            $table->string('barcode')->nullable();
        });

        Schema::table('manufacturer_product_details', function ($table) {
            $table->dropColumn('gtin');
        });
    }
}
