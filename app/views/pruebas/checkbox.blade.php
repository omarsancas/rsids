{{ Form::open (['route' => 'update', 'method' => 'UPDATE','class' => 'form-horizontal', 'role' => 'form', 'files' =>true]) }}


<legend>Aplicaciones</legend>
@foreach($aplicaciones as $aplicacion)
<div class="checkbox">
    <label>
        @if(in_array($aplicacion->APLI_ID_APLICACION, $aplicacionesseleccionadas))
        {{ Form::checkbox('aplicaciones[]', $aplicacion->APLI_ID_APLICACION, true) }}
        @else
        {{ Form::checkbox('aplicaciones[]', $aplicacion->APLI_ID_APLICACION, false) }}
        @endif
        {{ $aplicacion->APLI_NOMBRE}}
    </label>
</div>
@endforeach

<div class="form-group">

    @foreach($cuentascol as $key => $value)


    <div class="form-group">
        {{ Form::label('ap_pat', 'Apellido Paterno')}}
        <input class="form-control" name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_paterno]" type="text" value="{{$value->SOCO_AP_PATERNO}}" id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_paterno]">
    </div>

    <div class="form-group">
        {{ Form::label('ap_pat', 'Apellido Materno')}}
        <input class="form-control" name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_materno]" type="text" value="{{$value->SOCO_AP_MATERNO}}" id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_materno]">
    </div>


    <div class="form-group">
        {{ Form::label('solcol[][soco_nombres]', 'Nombre')}}
        <input class="form-control" name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_nombres]" type="text" value="{{$value->SOCO_NOMBRES}}" id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_nombres]">
    </div>

    <div class="form-group">

        {{ Form::label('solcol[][soco_nombres]', 'Nombre')}}
        <input class="form-control" name="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono1]" type="text" value="{{$value->MECO_TELEFONO1}}" id="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono1]">
    </div>


    @endforeach

    <div class="form-group">
        <p>
            <input type="submit" value="Enviar" class="btn btn-success btn-lg">
        </p>
    </div>
    {{ Form::close() }}