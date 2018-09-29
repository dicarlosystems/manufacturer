<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameGtinToUpc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manufacturer_product_details', function(Blueprint $table) {
            $table->renameColumn('gtin', 'upc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manufacturer_product_details', function(Blueprint $table) {
            $table->renameColumn('upc', 'gtin');
        });
    }
}
