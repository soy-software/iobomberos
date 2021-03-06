<?php

namespace iobom\Policies;

use Carbon\Carbon;
use iobom\User;
use iobom\Models\Asistencia\Asistencia;
use Illuminate\Auth\Access\HandlesAuthorization;

class AsistenciaPolicy
{
    use HandlesAuthorization;
    
   

    public function tomarAsistencia(User $user, Asistencia $asistencia)
    {
        if(
            $user->can('Generar asistencia') && 
            $user->hasRole('Clase de guardía') && 
            $user->estacion->id==$asistencia->estacion->id &&
            Carbon::parse($asistencia->fecha)->format('Y-m-d')==Carbon::now()->toDateString()
        ){
            return true;
        }

        if(
            $user->can('Generar asistencia') && 
            $user->hasRole('Oficial de guardía') &&
            Carbon::parse($asistencia->fecha)->format('Y-m-d')==Carbon::now()->toDateString()
        ){
            return true;
        }
    }

    
}
