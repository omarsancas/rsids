{{ Form::open() }}

<!-- Get a list of our ID's so we can check/uncheck the checkboxes as we go -->
<!--->


<legend>Aplicaciones</legend>
@foreach($aplicaciones as $aplicacion)
<div class="checkbox">
    <label>
        @if(in_array($aplicacion->APLI_ID_APLICACION, $aplicacionesseleccionadas))
        {{ Form::checkbox('categories[]', $aplicacion->APLI_ID_APLICACION, true) }}
        @else
        {{ Form::checkbox('categories[]', $aplicacion->APLI_ID_APLICACION, false) }}
        @endif
        {{ $aplicacion->APLI_NOMBRE}}
    </label>
</div>
@endforeach




