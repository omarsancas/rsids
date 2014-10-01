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


<legend>Datos generales del titular</legend>
@foreach($cuentascol as $cuentacol)
<div class="form-group">
    {{ Form::label('nombre', 'Nombre')}}
    {{ Form::text('nombre', $cuentacol->SOCO_NOMBRES, ['class' => 'form-control'])}}
</div>

<div class="form-group">
    {{ Form::label('apellidoPaterno', 'Apellido Paterno')}}
    {{ Form::text('apellidoPaterno', $cuentacol->SOCO_AP_PATERNO, ['class' => 'form-control'])}}
</div>


<div class="form-group">
    {{ Form::label('apellidoMaterno', 'Apellido Materno')}}
    {{ Form::text('apellidoMaterno', $cuentacol->SOCO_AP_MATERNO, ['class' => 'form-control'])}}
</div>

@endforeach




