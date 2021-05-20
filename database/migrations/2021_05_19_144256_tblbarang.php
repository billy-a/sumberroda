<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tblbarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblbarang', function (Blueprint $table) {
            $table->increments('idbrg');
            $table->string('namabrg');
            $table->integer('idkategori');
            $table->integer('idbrand');
            $table->string('lebarban','5');
            $table->string('rasioban','5');
            $table->string('diameterban','5');
            $table->text('infoservis');
            $table->text('detail');
            $table->integer('stok');
            $table->bigInteger('hargabeli');
            $table->bigInteger('hargajual');
            $table->bigInteger('hargajasa');
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
        Schema::dropIfExists('tblbarang');
    }
}
