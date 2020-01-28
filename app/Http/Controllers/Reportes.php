<?php

namespace iobom\Http\Controllers;

use Illuminate\Http\Request;
use iobom\Models\Emergencia\Emergencia;
use iobom\Models\FormularioEmergencia;
use PDF;

class Reportes extends Controller
{
    public function estadisticas()
    {
        $fecha="2020-01";
        $emergencia=Emergencia::get();
        
        // foreach ($emergencia as $emergencia) {
        //     echo $emergencia->formularios ."</br>";

        // }
        $data = array('emergencias' =>$emergencia , );
        return view('reportes.estadisticas',$data);
    }
    public function resporteMes(Request $request)
    {

        $bucarFormularios=FormularioEmergencia::whereYear('fecha',date('Y',strtotime($request->fecha)))
        ->whereMonth('fecha',date('m',strtotime($request->fecha)))
        ->orderBy('fecha','asc')->get();
        $data = array('formularios' =>$bucarFormularios ,'fecha'=>$request->fecha );
        return view('reportes.reporte',$data);
        
        
    }
    public function exportarReporte($fecha)
    {
        $bucarFormularios=FormularioEmergencia::whereYear('fecha',date('Y',strtotime($fecha)))
        ->whereMonth('fecha',date('m',strtotime($fecha)))
        ->orderBy('fecha','asc')->get();
        $data = array('formularios' =>$bucarFormularios ,'fecha'=>$fecha );

        $pdf = Pdf::loadView('reportes.exportarPdf', $data)
        ->setOrientation('landscape')
        ->setPaper('a4')
        ->setOption('margin-top', '25')
        ->setOption('margin-bottom', '30mm')
        ->setOption('margin-left', '15mm')
        
        ->setOption('margin-right', '15mm');
 
        return $pdf->inline();
    }
    public function headrePdf()
    {
        return view('reportes.header');
    }
}