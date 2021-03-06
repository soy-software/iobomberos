<?php

namespace iobom\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use iobom\Models\Asistencia\Asistencia;
use iobom\User;

class Estacion extends Model
{
	protected $table="estacion";
	
    protected $fillable = [
        'nombre', 'direccion', 'latitud','longitud','creadoPor','actualizadoPor',
    ];


    
    public function personales()
    {
        return $this->hasMany(User::class);
    }


    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }


    // A:Deivid
    // D:vehiculos disponibles para emergencia solo en estado=disponible
    public function vehiculosDisponibles()
    {
        return $this->hasMany(Vehiculo::class)->where('estado','Disponible');
    }


    public function asistenciasHoy()
    {
        $diaHoy=Carbon::now();
        $sumarUnDia=$diaHoy->addDays(1);
        $fechaMenor=$diaHoy->setDateTime($sumarUnDia->year,$sumarUnDia->month,$sumarUnDia->day,7,30,0,0)->toDateTimeString();
        return $this->hasMany(Asistencia::class)
        ->where('fecha',Carbon::now()->toDateString())->where('fechaFin','<=',$fechaMenor);
    }
  
    public function asistenciaHoy()
    {
        $diaHoy=Carbon::now();
        $sumarUnDia=$diaHoy->addDays(1);
        $fechaMenor=$diaHoy->setDateTime($sumarUnDia->year,$sumarUnDia->month,$sumarUnDia->day,7,30,0,0)->toDateTimeString();
        return $this->hasOne(Asistencia::class)
        ->where('fecha',Carbon::now()->toDateString())->where('fechaFin','<=',$fechaMenor);
    } 
    
    
    public function asistenciaCreada($date,$idEstacion)
    {      
        $diaHoy1= Carbon::parse($date)->format('Y-m-d');
        $diaHoy=Carbon::parse($date);
        $sumarUnDia=$diaHoy->addDays(1);
        $fechaMenor=$diaHoy->setDateTime($sumarUnDia->year,$sumarUnDia->month,$sumarUnDia->day,7,30,0,0)->toDateTimeString();
        return Asistencia::where('fecha', 'like',  '%'.$diaHoy1 .'%')
        ->where('fechaFin','<=',$fechaMenor)
        ->where('estacion_id',$idEstacion)->first();
    }
    public function asistenciaCreadaEditar($date,$idEstacion)
    {      
        $diaHoy1= Carbon::parse($date)->format('Y-m-d');
        $diaHoy=Carbon::parse($date);
        $sumarUnDia=$diaHoy->addDays(1);
        $fechaMenor=$diaHoy->setDateTime($sumarUnDia->year,$sumarUnDia->month,$sumarUnDia->day,7,30,0,0)->toDateTimeString();
        return Asistencia::where('fecha', 'like',  '%'.$diaHoy1 .'%')
        ->where('fechaFin','<=',$fechaMenor)
        ->where('estacion_id',$idEstacion)->first();
    }

}
