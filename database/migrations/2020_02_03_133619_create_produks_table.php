<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('currency_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->string('barcode');
            $table->string('nama');
            $table->bigInteger('stok')->unsigned();
            $table->string('harga_beli');
            $table->string('harga_jual');
            $table->string('diskon')->nullable();
            $table->string('laba')->nullable();
            $table->string('ppn')->nullable();
            $table->text('keterangan');
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
        Schema::dropIfExists('produks');
    }
}
