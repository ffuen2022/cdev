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
        Schema::create('sdr_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sdr_dao_id')->constrained()->onDelete('cascade');
            $table->string('item');
            $table->string('descripcion');
            $table->string('unidad_medida');
            $table->string('cantidad');
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
        Schema::dropIfExists('sdr_productos');
    }
};
