<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_noticias', function (Blueprint $table) {
            //le quitamos el campo nombre galeria_noticias
            $table->id();
            $table->string('gnot_path',500);
            $table->integer('gnot_orden'); //le quitamos el ->unique()
            $table->foreignId('gnot_noticias_id')->references('id')->on('noticias')->onDelete('cascade');
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
        Schema::dropIfExists('galeria_noticias');
    }
}
