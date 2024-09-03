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
        Schema::create('sdr_daos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('solicitado_por');
            $table->string('unidad');
            $table->date('fecha_unidad');
            $table->string('cuenta_presupuestaria');
            $table->string('folio_sdr');
            $table->foreignId('id_materiales')->constrained('mat_her_veis');
            $table->string('justificacion_del_requerimiento');
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
        Schema::dropIfExists('sdr_daos');
    }
};
