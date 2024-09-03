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
        Schema::create('solicitud_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sdr_dao_id')->constrained()->onDelete('cascade');
            $table->string('numero_solicitud');
            $table->string('archivo')->nullable();
            $table->string('fecha_emision')->nullable();
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
        Schema::dropIfExists('solicitud_pedidos');
    }
};
