@extends('layouts.app',['title'=>'Vehículos'])

@section('breadcrumbs', Breadcrumbs::render('tipoVehiculo')) 

@section('barraLateral')
 <div class="breadcrumb justify-content-center">
           
    <a href="{{ route('importarVehiculos') }}" class="breadcrumb-elements-item">
        <i class="fas fa-file-excel"></i>
        Importar vehículos
    </a>
     
    </div>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <form action="{{ route('guardarTipoVehiculo') }}" method="POST" id="formGuardar">
            @csrf
            <label for="nombre">Nombre del tipo de vehículo</label>
            <div class="input-group mb-3">
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese nombre.." aria-label="Recipient's username" aria-describedby="basic-addon2" required>
               <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror" placeholder="Ingrese código.." aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                    <button class="btn btn-dark" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
            <div class="table-responsive">
                {!! $dataTable->table()  !!}
            </div>
    </div>

</div>



@push('linksCabeza')
{{--  datatable  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plus/DataTables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('admin/plus/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{--  validate  --}}
<script src="{{ asset('admin/plus/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/plus/validate/messages_es.min.js') }}"></script>

@endpush

@prepend('linksPie')
    <script>

        $('#menuVehiculos').addClass('active');

        $( "#formGuardar" ).validate({
            rules: {
                nombre: {
                    required: true,
                    maxlength: 191
                }
            },
        });

        function eliminar(arg){
        
            swal({
                title: "¿Estás seguro?",
                text: "Que desea eliminar esta emergencia !",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-dark",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText:"Cancelar",
                closeOnConfirm: false
            },
            function(){
                swal.close();
                $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                $.post( "{{ route('eliminarTipoVehiculo') }}", { tipo: $(arg).data('id') })
                .done(function( data ) {
                    if(data.success){
                        $('#dataTableBuilder').DataTable().draw(false);
                        notificar("info",data.success);
                    }
                    if(data.default){
                        notificar("default",data.default);   
                    }
                    console.log(data)
                }).always(function(){
                    $.unblockUI();
                }).fail(function(){
                    notificar("error","Ocurrio un error");
                });
    
            });
        }

        
    </script>
    {!! $dataTable->scripts() !!}
    
@endprepend

@endsection