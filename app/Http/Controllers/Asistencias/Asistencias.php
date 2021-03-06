<?php

namespace iobom\Http\Controllers\Asistencias;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use iobom\Http\Controllers\Controller;
use iobom\Models\Asistencia\Asistencia;
use iobom\Models\Asistencia\AsistenciaPersonal;
use iobom\Models\Asistencia\AsistenciaVehiculo;
use iobom\Models\Estacion;
use PDF;

class Asistencias extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','permission:Generar asistencia']);
    }

    public function index()
    {
        $estaciones=Estacion::all();
        $data = array('estaciones' => $estaciones );
        return view('asistencias.index',$data);
    }

    public function crearAsistencia($idEstacion)
    {
        $estacion=Estacion::findOrFail($idEstacion);
        
        $asistencia=$estacion->asistenciasHoy()->first();

        if ($asistencia) {
           $asistencia=$this->listadoPersonal($estacion->id);
        }

        $data = array('estacion' => $estacion,'asistencia'=>$asistencia );
        return view('asistencias.generar',$data);
       
    }

    public function crearNuevaAsistencia(Request $request)
    {
        $estacion=Estacion::findOrFail($request->estacion);
        $this->authorize('generarAsistencia', $estacion);
        $asistencia=$this->listadoPersonal($estacion->id);
        return response(['success'=>'ok']);
    }
    public function listadoPersonal($Idestacion)
    {
        
        $estacion=Estacion::findOrFail($Idestacion);
        $this->authorize('generarAsistencia', $estacion);
        $asistencia=$estacion->asistenciasHoy()->first();
        $diaHoy=Carbon::now();
        $sumarUnDia=$diaHoy->addDays(1);

        if(!$asistencia){
            $asistencia=new Asistencia();
            $asistencia->estacion_id=$estacion->id;
            $asistencia->fecha=Carbon::now()->toDateString();
            $asistencia->fechaFin=$diaHoy->setDateTime($sumarUnDia->year,$sumarUnDia->month,$sumarUnDia->day,7,30,0,0)->toDateTimeString();
            $asistencia->user_id=Auth::id();
            $asistencia->save();
        }
        
         $mipersonaldeasitenciatomada= $asistencia->asistenciaPersonal->pluck('id');
         $mipersonalxestacion=$estacion->personales->pluck('id');
         $uniontodospersonal=$mipersonaldeasitenciatomada->merge($mipersonalxestacion);
        $asistencia->asistenciaPersonal()->sync($uniontodospersonal);

        $mivehiculosasistenciatomada=$asistencia->asistenciaVehiculo->pluck('id');
        $mivehiculosxestacion=$estacion->vehiculos->pluck('id');
        $miuniontodosvehiculos=$mivehiculosasistenciatomada->merge($mivehiculosxestacion);

        $asistencia->asistenciaVehiculo()->sync($miuniontodosvehiculos);
       
        
        return $asistencia;
    }

    public function estadoPersonal(Request $request)
    {
        $asistenciaPersonal=AsistenciaPersonal::findOrFail($request->id);
        
        $asistencia=$asistenciaPersonal->asistencia;
        $this->authorize('tomarAsistencia', $asistencia);

        $msg='';
        if($asistenciaPersonal->estado){
            $asistenciaPersonal->estado=false;
            $msg=$asistenciaPersonal->usuario->name.' no asiste';
        }else{
            $asistenciaPersonal->estado=true;
            $asistenciaPersonal->observacion='';
            $msg=$asistenciaPersonal->usuario->name.' si asiste';
        }
        $asistenciaPersonal->save();
        return response()->json(['success'=>$msg]);
    }

    public function estadoVehiculo(Request $request)
    {
        $asistenciaVehiculo=AsistenciaVehiculo::findOrFail($request->id);
        
        $asistemcia=$asistenciaVehiculo->asistencia;
        $this->authorize('tomarAsistencia', $asistemcia);

        $msg='';
        if($asistenciaVehiculo->estado){
            $asistenciaVehiculo->estado=false;
            $vehiculo=$asistenciaVehiculo->vehiculo;
            $msg=$vehiculo->tipoVehiculo->nombre.' '.$vehiculo->tipoVehiculo->codigo .'-'.$vehiculo->codigo.' no asiste';
        }else{
            $asistenciaVehiculo->estado=true;
            $asistenciaVehiculo->observacion='';
            $vehiculo=$asistenciaVehiculo->vehiculo;
            $msg=$vehiculo->tipoVehiculo->nombre.' '.$vehiculo->tipoVehiculo->codigo .'-'.$vehiculo->codigo.' si asiste';
        }
        $asistenciaVehiculo->save();
        return response()->json(['success'=>$msg]);
    }

    public function obsPersonal(Request $request)
    {
        $asistenciaPersonal=AsistenciaPersonal::findOrFail($request->id);
        $asistencia=$asistenciaPersonal->asistencia;
        $this->authorize('tomarAsistencia', $asistencia);

        if($asistenciaPersonal->estado==false){
            $asistenciaPersonal->observacion=$request->detalle;
        }

        $asistenciaPersonal->save();
        return response()->json(['success'=>'Observación actualizado']);
    }
    public function obsVehiculo(Request $request)
    {
        $asistenciaVehiculo=AsistenciaVehiculo::findOrFail($request->id);
        
        $asistemcia=$asistenciaVehiculo->asistencia;
        $this->authorize('tomarAsistencia', $asistemcia);
        
        if($asistenciaVehiculo->estado==false){
            $asistenciaVehiculo->observacion=$request->detalle;
        }
        $asistenciaVehiculo->save();
        return response()->json(['success'=>'Observación actualizado']);
    }


    public function exportarPdf($idAsistencia)
    {
        $asistencia=Asistencia::findOrFail($idAsistencia);
        $data = array('asistencia'=>$asistencia);
        $pdf = PDF::loadView('asistencias.exportarPdf',$data);
        return $pdf->inline('asistencia_'.$asistencia->fecha.'.pdf');
    }


    public function buscarAsistencia(Request $request, $idEstacion)
    {
        $asistencia=Asistencia::where(['fecha'=>$request->fecha,'estacion_id'=>$idEstacion])->first();    
       
        $fecha=$request->fecha;
        $estacion=Estacion::findOrFail($idEstacion);
        $data = array('asistencia' =>$asistencia,'estacion'=>$estacion,'fecha'=>$fecha );
        return view('asistencias.buscarPorFecha',$data)->withInput($request->fecha??'');
        
    }
    
}
