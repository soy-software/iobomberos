<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
	<a href="#" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Información {{ $formulario->emergencia->nombre }}">
        <i class="fas fa-eye"></i>
    </a>
    <a  href="#" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar {{ $formulario->emergencia->nombre }}">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" onclick="eliminar(this);" data-id="{{ $formulario->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{$formulario->emergencia->nombre}}">
        <i class="fas fa-trash-alt"></i>
    </button>
    
</div>