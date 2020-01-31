<?php

namespace iobom\Models\FormularioEmergencia;;

use Illuminate\Database\Eloquent\Model;
use iobom\Models\Asistencia\AsistenciaPersonal;

class VehiculoOperador extends Model
{
    public function asistenciaPersonal()
    {
        return $this->belongsTo(AsistenciaPersonal::class,'asistenciaPersonal_id');
    }
    public function vehiculoEstacion()
    {
        return $this->belongsTo(FormularioEstacionVehiculo::class,'estacionForVehiculo_id');
    }
}
