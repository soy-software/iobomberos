<?php

namespace iobom\Models;

use Illuminate\Database\Eloquent\Model;
use iobom\Models\Asistencia\AsistenciaPersonal;
use iobom\Models\Emergencia\Emergencia;
use iobom\Models\FormularioEmergencia\AtencionPrehospitalaria;
use iobom\Models\FormularioEmergencia\Edificacion;
use iobom\Models\FormularioEmergencia\EstacionFormularioEmergencia;
use iobom\Models\FormularioEmergencia\EtapaIncendio;
use iobom\Models\FormularioEmergencia\Material;
use iobom\Models\FormularioEmergencia\Danio;
use iobom\Models\PuntoReferencia;
use iobom\User;


class FormularioEmergencia extends Model
{
    protected $table="formularioEmergencia";


    // A:Derivid
    // D: un formulario tiene una emergencia
    public function emergencia()
    {
        return $this->belongsTo(Emergencia::class, 'emergencia_id');
    }

    public function puntoReferencia()
    {
        return $this->belongsTo(PuntoReferencia::class, 'puntoReferencia_id');
    }



    // A:Deivid
    // D: un formulario tiene una maxima autoridad axignado
    public function maximaAutoridad()
    {
        return $this->belongsTo(User::class,'maximaAutoridad_id');
    }


    // A:Deivid
    // D: un formulario tiene un usuario responsable, quien creao el formulario
    public function responsable()
    {
        return $this->belongsTo(User::class,'creadoPor');
    }


    // A:Deivid
    // D:un formualrio tiene varias estaciones asignadas
    public function estaciones()
    {
        return $this->belongsToMany(Estacion::class, 'estacion_formulario_emergencias', 'formularioEmergencia_id', 'estacion_id')
        ->as('estacionFormulario')
        ->withPivot(['id','estacion_id','formularioEmergencia_id']);
    }

    // A:fabian
    // D:un formualrio una etapa de incendio
    public function etapaIncendio()
    {
        return $this->hasOne(EtapaIncendio::class,'formularioEmergencia_id');
    }

    // A:fabian
    // D:un formualrio tiene una edificacion
    public function edificacion()
    {
        return $this->hasOne(Edificacion::class,'formularioEmergencia_id');
    }

    public function estacionFormularioEmergencias()
    {
        return $this->hasMany(EstacionFormularioEmergencia::class,'formularioEmergencia_id');
    }
    public function creadoPorUsuario()
    {
        return $this->belongsTo(User::class, 'creadoPor');
    }
    
    // A:deivid
    // De: un formulario tiene una asistencia del encargado del formulario, para poder notificar la nueva emergencia 
    public function asitenciaEncardado()
    {
        return $this->belongsTo(AsistenciaPersonal::class, 'encardadoFicha_id');
    }
    //FAbian Lopez Buscar atension referente al formulario
    public function atenciones()
    {
        return $this->hasMany(AtencionPrehospitalaria::class,'formularioEmergencia_id');
    }
    //un formulario tiene varios materiales
    public function materiales()
    {
        return $this->hasMany(Material::class,'formularioEmergencia_id');
    }
    //un formulario tiene varios danios
    public function danios()
    {
        return $this->hasMany(Danio::class,'formularioEmergencia_id');
    }
}
