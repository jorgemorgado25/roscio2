<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatoRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plato_rubro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plato_id');
            $table->integer('rubro_id');
            $table->smallInteger('cantidad');
            $table->string('medida', 10);
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
        Schema::drop('plato_rubro');
    }
}
