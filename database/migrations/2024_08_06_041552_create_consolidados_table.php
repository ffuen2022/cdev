<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sdr_dao_id')->constrained()->onDelete('cascade');
            $table->date('fecha_ing_sp')->nullable();
            $table->date('fecha_recepcion_direccion')->nullable();
            $table->string('direccion');
            $table->string('estado')->default('inicio');
            $table->string('descripcion')->default('Sin Asignar');
            $table->string('unidad')->default('ADM');
            $table->string('observaciones')->default('Sin Asignar');
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
        Schema::dropIfExists('consolidados');
    }
};
