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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombreIndicador',50)->nullable();
            $table->string('codigoIndicador',50)->nullable();
            $table->string('unidadMedidaIndicador',50)->nullable();
            $table->double('valorIndicador')->nullable();
            $table->date('fechaIndicador')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicadores');
    }
};
