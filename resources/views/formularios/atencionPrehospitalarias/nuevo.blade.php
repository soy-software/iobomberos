@extends('layouts.app',['title'=>'Nuevo Registro Pre-Hospitalaria '])
@section('breadcrumbs', Breadcrumbs::render('nuevoRegistroHospitalario',$formulario))
@section('content')
<div class="card">
    <div class="card-header text-center">
        Nuevo registro de atención Pre-Hospitalaria del formulario N° <strong> {{$formulario->numero}} </strong>
    </div>
    <div class="card-body">
        <form action="{{ route('guardar-atencion') }}" method="POST" >
            @csrf
                <input type="hidden" value="{{$formulario->id}}" name="formulario">
                <div class="form-group">
                        <label for="numero">N° de Registro<i class="text-danger">*</i></label>
                        <input  type="text" class="form-control {{ $errors->has('numero') ? ' is-invalid' : '' }}"  id="numero"  value="{{ old('numero') }}" name="numero" placeholder="Ingrese.." required>                    
                        @if ($errors->has('numero'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('numero') }}</strong>
                            </span>
                        @endif
                    </div>
                <div class="form-group">
                    <label for="ambulancia">N° Ambulancia<i class="text-danger">*</i></label>
                    <input  type="text" class="form-control {{ $errors->has('ambulancia') ? ' is-invalid' : '' }}"  id="ambulancia"  value="{{ old('ambulancia') }}" name="ambulancia" required placeholder="Ingrese.."> 
                    @if ($errors->has('ambulancia'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ambulancia') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="text-center bg-dark">
                            <th colspan="5">
                                <strong>  Datos Generales </strong>
                            </th>
                        </tr>
                        <tr>
                            <th  colspan="2">
                                <label for="nombres">Nombres<i class="text-danger">*</i></label>
                                <input  type="text"  value="{{ old('nombres') }}" name="nombres" value="{{ old('nombres') }}" class="form-control {{ $errors->has('nombres') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required >
                                @if ($errors->has('nombres'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </th>
                            <th>
                                <div class="form-group">
                                    <label for="tipo_identificacion">Tipo de identificación<i class="text-danger">*</i></label>
                                    <select id="tipo_identificacion" class="form-control @error('tipo_identificacion') is-invalid @enderror" name="tipo_identificacion" required>
                                        <option value="Cédula" {{ old('tipo_identificacion')=='Cédula'?'selected':'' }}>Cédula</option>
                                        <option value="Ruc persona Natural" {{ old('tipo_identificacion')=='Ruc persona Natural'?'selected':'' }}>Ruc persona Natural</option>
                                        <option value="Ruc Sociedad Pública" {{ old('tipo_identificacion')=='Ruc Sociedad Pública'?'selected':'' }}>Ruc Sociedad Pública</option>
                                        <option value="Ruc Sociedad Privada" {{ old('tipo_identificacion')=='Ruc Sociedad Privada'?'selected':'' }}>Ruc Sociedad Privada</option>
                                        <option value="Pasaporte" {{ old('tipo_identificacion')=='Pasaporte'?'selected':'' }}>Pasaporte</option>
                                        <option value="Otros" {{ old('tipo_identificacion')=='Otros'?'selected':'' }}>Otros</option>
                                        
                                    </select>
                                    @error('tipo_identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="identificacion">Identificación<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control @error('identificacion') is-invalid @enderror" id="identificacion" name="identificacion" value="{{ old('identificacion') }}" required placeholder="Ingrese..">
                                    @error('identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </th>
                            <th>
                                <label for="edad">Edad<i class="text-danger">*</i></label>
                                <input  type="text"  value="{{ old('edad') }}" id="edad" name="edad" class="form-control {{ $errors->has('edad') ? ' is-invalid' : '' }}" required>
                                @if ($errors->has('edad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('edad') }}</strong>
                                    </span>
                                @endif
                            </th>
                            <th>
                                <label for=""> Sexo<i class="text-danger">*</i></label>
                                <div class="form-group row">
                                        
                                        <div class="custom-control custom-radio">
                                            <input  type="radio" class="custom-control-input {{ $errors->has('sexo') ? ' is-invalid' : '' }}" value="Hombre" id="Hombre"  value="{{ old('apellidos') }}" name="sexo"   {{ old('sexo')=='Hombre'?'checked':'checked' }}>
                                            <label class="custom-control-label" for="Hombre">Hombre</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-1">
                                            <input type="radio" class="custom-control-input{{ $errors->has('sexo') ? ' is-invalid' : '' }}" value="Mujer" id="Mujer"  value="{{ old('apellidos') }}" name="sexo"  {{ old('sexo')=='Mujer'?'checked':'' }}>
                                            <label class="custom-control-label" for="Mujer">Mujer</label>
                                            
                                            @if ($errors->has('sexo'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sexo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                            </th>
                        </tr>
                        <tr>
                            <th >
                                <label for="horaAtencion">Hora<i class="text-danger">*</i></label>
                                <input type="time"   value="{{ old('horaAtencion') }}" name="horaAtencion" id="horaAtencion" class="form-control {{ $errors->has('horaAtencion') ? ' is-invalid' : '' }}" required>
                                @if ($errors->has('horaAtencion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('horaAtencion') }}</strong>
                                    </span>
                                @endif
                            </th>
                            <th>
                                <strong>Dirección Evento : </strong> <br>{{$formulario->direcionAdicional??' No existe referencia'}}</th>
                            <th>
                                <strong>Punto Referencia : </strong> <br>{{$formulario->puntoReferencia->referencia??'No existe punto de referencia'}}</th>
                            <th>
                                <strong>Fecha Atención : </strong> <br>{{$formulario->fecha}}</th>
                            <th>
                                <label for="placa">Número de placa</label>
                                <input type="text"  value="{{ old('placa') }}" name="placa" id="placa" class="form-control {{ $errors->has('placa') ? ' is-invalid' : '' }}" placeholder="Ingrese.." >
                            </th>
                        </tr>

                    </table>
                </div>
                <br>
                <p class="bg-dark text-center p-2"> <strong>Examen Físico y Diagnóstico</strong></p>
                <div class="form-group">
                    <label for="diagnostico">Diagnóstico Presuntivo<i class="text-center">*</i></label>                    
                    <textarea  class="form-control {{ $errors->has('diagnostico') ? ' is-invalid' : '' }}"  id="diagnostico"   name="diagnostico" required>{{ old('diagnostico') }}</textarea>                    
                    @if ($errors->has('diagnostico'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('diagnostico') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="text-center bg-dark">
                            <th colspan="5">
                                <strong>Signos vitales</strong>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="pulso">Pulso<i class="text-danger">*</i></label>
                                    <input  type="number"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" id="pulso"  value="{{ old('pulso') }}" name="pulso"  class="form-control {{ $errors->has('pulso') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required>
                                    @if ($errors->has('pulso'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pulso') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </th>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="temperatura">Temperatura<i class="text-danger">*</i></label>
                                    <input  type="number"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" id="temperatura"  value="{{ old('temperatura') }}" name="temperatura" value="" class="form-control {{ $errors->has('temperatura') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required>
                                    @if ($errors->has('temperatura'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('temperatura') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </th>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="presion">Presión Arterial<i class="text-danger">*</i></label>
                                    <input  type="text"  id="presion"  value="{{ old('presion') }}" name="presion"  class="form-control {{ $errors->has('presion') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required>
                                    @if ($errors->has('presion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('presion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </th>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="sp">SP02%<i class="text-danger">*</i></label>
                                    <input  type="number" id="sp"  value="{{ old('sp') }}" name="sp" class="form-control {{ $errors->has('sp') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required>
                                    @if ($errors->has('sp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </th>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="glasgow">Total Glasgow (15)<i class="text-danger">*</i> </label>
                                    <input  type="number" id="glasgow"  value="{{ old('glasgow') }}" name="glasgow" class="form-control {{ $errors->has('glasgow') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required >
                                    @if ($errors->has('glasgow'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('glasgow') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </th>                            
                        </tr>
                        <tr>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="reaccionDerecha">Reacción (RN-RL-RR)</label>
                                    
                                    <div class="custom-control custom-radio">
                                        <input  type="radio" class="custom-control-input {{ $errors->has('reaccionDerecha') ? ' is-invalid' : '' }}" value="RN" id="RN" name="reaccionDerecha"   {{ old('reaccionDerecha')=='RN'?'checked':'checked' }}>
                                        <label class="custom-control-label" for="RN">RN</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-1">
                                        <input type="radio" class="custom-control-input{{ $errors->has('reaccionDerecha') ? ' is-invalid' : '' }}" value="RL" id="RL" name="reaccionDerecha"  {{ old('reaccionDerecha')=='RL'?'checked':'' }}>
                                        <label class="custom-control-label" for="RL">RL</label>
                                    </div> 
                                    <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('reaccionDerecha') ? ' is-invalid' : '' }}" value="RR" id="RR" name="reaccionDerecha"   {{ old('reaccionDerecha')=='RR'?'checked':'' }}>
                                            <label class="custom-control-label" for="RR">RR</label>
                                            
                                    @if ($errors->has('reaccionDerecha'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reaccionDerecha') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="dilatacionDerecha">Dilatación (DN-DD-DA)</label>                                    
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input {{ $errors->has('dilatacionDerecha') ? ' is-invalid' : '' }}" value="DN" id="DN" name="dilatacionDerecha"   {{ old('dilatacionDerecha')=='DN'?'checked':'checked' }}>
                                        <label class="custom-control-label" for="DN">DN</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-1">
                                        <input type="radio" class="custom-control-input{{ $errors->has('dilatacionDerecha') ? ' is-invalid' : '' }}" value="DD" id="DD" name="dilatacionDerecha"  {{ old('dilatacionDerecha')=='DD'?'checked':'' }}>
                                        <label class="custom-control-label" for="DD">DD</label>
                                    </div> 
                                    <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('dilatacionDerecha') ? ' is-invalid' : '' }}" value="DA" id="DA" name="dilatacionDerecha"   {{ old('dilatacionDerecha')=='DA'?'checked':'' }}>
                                            <label class="custom-control-label" for="DA">DA</label>
                                            
                                    @if ($errors->has('dilatacionDerecha'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dilatacionDerecha') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="reaccionIzquierda">Reacción (RN-RL-RR)</label>
                                    
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input {{ $errors->has('reaccionIzquierda') ? ' is-invalid' : '' }}" value="RN1" id="RN1" name="reaccionIzquierda"   {{ old('reaccionIzquierda')=='RN1'?'checked':'checked' }}>
                                        <label class="custom-control-label" for="RN1">RN</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-1">
                                        <input type="radio" class="custom-control-input{{ $errors->has('reaccionIzquierda') ? ' is-invalid' : '' }}" value="RL1" id="RL1" name="reaccionIzquierda"  {{ old('reaccionIzquierda')=='RL1'?'checked':'' }}>
                                        <label class="custom-control-label" for="RL1">RL</label>
                                    </div> 
                                    <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('reaccionIzquierda') ? ' is-invalid' : '' }}" value="RR1" id="RR1" name="reaccionIzquierda"   {{ old('reaccionIzquierda')=='RR1'?'checked':'' }}>
                                            <label class="custom-control-label" for="RR1">RR</label>
                                            
                                    @if ($errors->has('reaccionIzquierda'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reaccionIzquierda') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group" class="text-center">
                                    <label for="dilatacionIzquierda">Dilatación (DN-DD-DA)</label>
                                    
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input {{ $errors->has('dilatacionIzquierda') ? ' is-invalid' : '' }}" value="DN1" id="DN1" name="dilatacionIzquierda"   {{ old('dilatacionIzquierda')=='DN1'?'checked':'checked' }}>
                                        <label class="custom-control-label" for="DN1">DN</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-1">
                                        <input type="radio" class="custom-control-input{{ $errors->has('dilatacionIzquierda') ? ' is-invalid' : '' }}" value="DD1" id="DD1" name="dilatacionIzquierda"  {{ old('dilatacionIzquierda')=='DD1'?'checked':'' }}>
                                        <label class="custom-control-label" for="DD1">DD</label>
                                    </div> 
                                    <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('dilatacionIzquierda') ? ' is-invalid' : '' }}" value="DA1" id="DA1" name="dilatacionIzquierda"   {{ old('dilatacionIzquierda')=='DA1'?'checked':'' }}>
                                            <label class="custom-control-label" for="DA1">DA</label>
                                            
                                    @if ($errors->has('dilatacionIzquierda'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dilatacionIzquierda') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </table>
                </div>
                <p class="bg-dark text-center p-2"> <strong>Condición de llegada al hospital</strong></p>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group" class="text-center">
                        <label for="clinica">Selecione un establecimiento que recibe<i class="text-danger">*</i></label>
                        @if ($clinicas->count()>0)                        
                        <select  class="form-control {{ $errors->has('clinica') ? ' is-invalid' : '' }}"   name="clinica" id="clinica" required >
                            @foreach ($clinicas as $clinica)
                            <option value="{{$clinica->id}}" {{ (old("clinica") == $clinica->id ? "selected":"") }}>{{$clinica->nombre}}</option>                            
                            @endforeach
                            @if ($errors->has('clinica'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('clinica') }}</strong>
                                </span>
                            @endif
                        </select>
                        @else
                            <div class="alert alert-danger" role="alert">
                                No existe clinicas
                            </div>
                        @endif
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group"  class="text-center">
                            <label for="resposableRecibe">Responsable que recibe<i class="text-danger">*</i></label>
                            <input type="text" id="resposableRecibe"  value="{{ old('resposableRecibe') }}" name="resposableRecibe" class="form-control {{ $errors->has('resposableRecibe') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required>
                            @if ($errors->has('resposableRecibe'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('resposableRecibe') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group"  class="text-center">
                            <label for="horaEntrada">Hora de entrada<i class="text-danger">*</i></label>
                            <input type="time" id="horaEntrada"  value="{{ old('horaEntrada') }}" name="horaEntrada"  class="form-control {{ $errors->has('horaEntrada') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('horaEntrada'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('horaEntrada') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <p class="bg-dark text-center p-2"> <strong>Descargo de medicamentos e insumos</strong></p>
                @if ($insumos->count()>0)
                    <div class="row"> 
                        @foreach ($insumos as $insumo)
                            <div class="col-sm-4">
                                <table class="table-bordered ">
                                    <thead>
                                        <tr class="text-center bg-orange">
                                            <th colspan="2">
                                                <strong>{{$insumo->nombre}}</strong></p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($insumo->medicamentos as $medicamento)
                                        <tr>
                                            <td>                                                
                                                {{$medicamento->nombre}}                                     
                                            </td>
                                            <td>
                                                <input type="hidden"  name="medicamentos[{{ $medicamento->id }}]" value="{{$medicamento->id}}"  >
                                                <input type="number" min="0" name="cantidades[{{ $medicamento->id }}]" value="{{ old('cantidades.'.$medicamento->id) }}" class="form-control @error('cantidades.'.$medicamento->id) is-invalid @enderror" >
                                            </td>
                                        </tr>                                    
                                        @endforeach
                                    </tbody>
                                   
                                    </table>
                            </div>                            
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        No existen insumos 
                    </div>
                @endif

                <div class="bg-orange p-2">
                    <p class="p-2 text-center"><strong>  DESCARGO DE RESPONSABILIDADES </strong></p>
                    <div class="row">
                        <div class="col-sm-4 text-center">

                            <div class="form-group" class="text-center">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="Ninguno" id="Ninguna" name="tipoTransporte"   {{ old('tipoTransporte')=='Ninguno'?'checked':'' }}>
                                    <label class="custom-control-label" for="Ninguna">Ninguno</label>
                                </div>                               
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="Transporte Innecesario" id="Transporte Innecesario" name="tipoTransporte"   {{ old('tipoTransporte')=='Transporte Innecesario'?'checked':'' }}>
                                    <label class="custom-control-label" for="Transporte Innecesario">Transporte Innecesario</label>
                                </div>
                                <div class="custom-control custom-radio ml-1">
                                    <input type="radio" class="custom-control-input" value="Tratamiento Rehusado" id="Tratamiento Rehusado" name="tipoTransporte"  {{ old('tipoTransporte')=='Tratamiento Rehusado'?'checked':'' }}>
                                    <label class="custom-control-label" for="Tratamiento Rehusado">Tratamiento Rehusado</label>
                                </div> 
                                <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="Transporte Rehusado" id="Transporte Rehusado" name="tipoTransporte"   {{ old('tipoTransporte')=='Transporte Rehusado'?'checked':'' }}>
                                        <label class="custom-control-label" for="Transporte Rehusado">Transporte Rehusado</label>
                                        
                                @if ($errors->has('tipoTransporte'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipoTransporte') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="motivo">Motivo</label>                    
                                <textarea class="form-control {{ $errors->has('motivo') ? ' is-invalid' : '' }}"  id="motivo" name="motivo">{{ old('motivo') }}</textarea>                    
                                @if ($errors->has('motivo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('motivo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="p-2 text-justify"><strong> ME NIEDGO A RECIBIR ATENCIÓN PRE-HOSPITALARIA O INTERNACIÓN RECOMENDADA POR EL PERSONAL DE CUERPO DE BOMBEROS 
                        DE COTOPAX, HE SIDO INFORMADO DE LAS POSIBLES CONSECUENCIAS, ASUMO LO RIESGOS QUE SON DE MI EXCLUSIVA RESPONSABILIDAD </strong>
                    </p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" class="text-center">
                                <label for="nombresDescargo">Nombre</label>
                                <input type="text" id="nombresDescargo"  value="{{ old('nombresDescargo') }}" name="nombresDescargo"  class="form-control {{ $errors->has('nombresDescargo') ? ' is-invalid' : '' }}" >
                                @if ($errors->has('nombresDescargo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombresDescargo') }}</strong>
                                    </span>
                                @endif
                            </div>  
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" class="text-center">
                                <label for="cedulaDescargo">N°CI</label>
                                <input type="text" id="cedulaDescargo"  value="{{ old('cedulaDescargo') }}" name="cedulaDescargo"  class="form-control {{ $errors->has('cedulaDescargo') ? ' is-invalid' : '' }}" >
                                @if ($errors->has('cedulaDescargo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cedulaDescargo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Generar Registro</button>
                </div>

        </form>
     
    </div>
</div>
@prepend('linksPie')
<script type="text/javascript">
    $('#menuGestionFomularios').addClass('nav-item-expanded nav-item-open');
     $('#menuFormularios').addClass('active');
</script>
@endprepend
@endsection