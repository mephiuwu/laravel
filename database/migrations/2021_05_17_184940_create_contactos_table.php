<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            //cambiar prefijo de contact a con
            $table->id();
            $table->string('con_nombre');
            $table->unsignedBigInteger('con_id_asunto');
            $table->string('con_email',200);
            $table->string('con_telefono'); //de integer a ->string
            $table->text('con_mensaje');
            $table->string('con_path_documento')->nullable();
            $table->string('con_direccion');
            $table->foreignId('con_id_comuna')->nullable()->references('id')->on('comunas')->ondelete('SET NULL');
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
        Schema::dropIfExists('contactos');
    }
}
