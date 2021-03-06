<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormularioEmergenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularioEmergencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero')->unique();
            $table->dateTime('fecha');
            $table->time('horaSalida');
            $table->time('horaEntrada')->nullable();
            $table->string('institucion');
            $table->string('telefono')->nullable();
            $table->enum('formaAviso', ['Teléfonico', 'Personal']);
            $table->enum('estado', ['Asignado','Proceso', 'Finalizado']);
            $table->enum('frecuencia', ['Lunes-Viernes','Fin de semana', 'Feriado']);
            $table->integer('heridos')->default(0);
            $table->string('localidad')->nullable();
            $table->unsignedBigInteger('puntoReferencia_id')->nullable();
            $table->foreign('puntoReferencia_id')->references('id')->on('puntoReferencia');            

            $table->unsignedBigInteger('encardadoFicha_id')->nullable();
            $table->foreign('encardadoFicha_id')->references('id')->on('asistencia_personals');

            $table->unsignedBigInteger('maximaAutoridad_id')->nullable();
            $table->foreign('maximaAutoridad_id')->references('id')->on('users');

            $table->unsignedBigInteger('tipoEmergencia_id')->nullable();
            $table->foreign('tipoEmergencia_id')->references('id')->on('tipoEmergencia');
            
            $table->unsignedBigInteger('emergencia_id');            
            $table->foreign('emergencia_id')->references('id')->on('emergencia');
            
            $table->text('origenCausa')->nullable();
            $table->text('tabajoRealizado')->nullable();
            $table->text('condicionClimatica')->nullable();
            $table->enum('localidadEjecutada', ['Urbano','Rural'])->nullable();

            $table->bigInteger('creadoPor')->nullable();
            $table->bigInteger('actualizadoPor')->nullable();
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
        Schema::dropIfExists('formularioEmergencia');
    }
}
