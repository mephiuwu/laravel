<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string('emp_razon_social');
            $table->string('emp_email_empresarial');
            $table->string('emp_email_contacto');
            $table->string('emp_direccion',200);
            $table->string('emp_telefono',100);
            $table->string('emp_logo');
            $table->string('emp_url_facebook');
            $table->string('emp_url_twitter');
            $table->string('emp_url_instagram');
            $table->string('emp_url_youtube');
            $table->string('emp_coords_lat');   
            $table->string('emp_coords_lng');  
            $table->string('emp_meta_title');
            $table->string('emp_meta_keywords');
            $table->text('emp_meta_description');
            $table->text('emp_analytics');               
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
        Schema::dropIfExists('empresa');
    }
}
