@extends('layouts.app',['title'=>'Editar medicamento'])
@section('breadcrumbs', Breadcrumbs::render('editarMedicamento',$medi))
@section('barraLateral')

@endsection
@section('content')


<div class="card">

    <div class="card-header">
        <form action="{{ route('medicamentoActualizar') }}" method="POST" id="formGuardar">
            @csrf
            <input type="hidden" name="medi" value="{{ $medi->id }}" required>
            <label for="nombre">Nombre de medicamento<i class="text-danger">*</i></label>
            <div class="input-group mb-3">
                <input type="text" name="nombre" value="{{ old('nombre',$medi->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese nombre.." aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                    <button class="btn btn-dark" type="submit">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('linksCabeza')
{{-- validate --}}
<script src="{{ asset('admin/plus/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/plus/validate/messages_es.min.js') }}"></script>
@endpush

@prepend('linksPie')
  <script type="text/javascript">
       $('#menuGestionInformacion').addClass('nav-item-expanded nav-item-open');
        $('#menuMedicamentosInsumos').addClass('active');
        $( "#formGuardar" ).validate({
            rules: {
                nombre: {
                    required: true,
                    maxlength: 191
                }
            },
        });
  </script>
    
    
@endprepend

@endsection
