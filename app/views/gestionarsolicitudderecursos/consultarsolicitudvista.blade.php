@extends('layout')


@section('content')
<div class="container">

<div class="panel panel-default">
<div class="panel-heading">This Page is Disabled</div>
<div class="panel-body">
<div class="col-md-6">


<h1></h1>

<h1>Consultar solicitud de recursos {{  $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA}}</h1>
{{ Form::open (['route' => 'bajarcurriculum', 'method' => 'GET','class' => 'form-horizontal', 'role' =>'form', 'files' =>true]) }}
<input type="hidden" name="id" value="{{ $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA }}">
<input type="hidden" name="idmeco" value="{{ $meco->MECO_ID_MEDIO_COMUNICACION }}">
@if ($errors)
<div class="alert">
    <p style="color:red;">
        {{ implode('', $errors->all('
    <li>:message</li>
    ')) }}
    </p>
</div>
@endif

<fieldset>
    <legend>Datos generales del titular</legend>

    <div class="form-group">
        {{ Form::label('nombre', 'Nombre')}}
        {{ Form::text('nombre', $solicitudabstracta->SOAB_NOMBRES , ['class' => 'form-control', 'disabled' => 'disabled'])}}
        @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
    </div>

    <div class="form-group">
        {{ Form::label('apellidoPaterno', 'Apellido Paterno')}}
        {{ Form::text('apellidoPaterno', $solicitudabstracta->SOAB_AP_PATERNO, ['class' => 'form-control', 'disabled' => 'disabled'])}}
    </div>


    <div class="form-group">
        {{ Form::label('apellidoMaterno', 'Apellido Materno')}}
        {{ Form::text('apellidoMaterno', $solicitudabstracta->SOAB_AP_MATERNO, ['class' => 'form-control', 'disabled' => 'disabled'])}}
    </div>


    <div class="form-group">
        {{ Form::label('Sexo', 'Sexo')}}
    </div>
    <label class="radio-inline control-label">

        {{ Form::Radio('sexo','m', ($solicitudabstracta->SOAB_SEXO == 'm') ? true : false,[ 'disabled' => 'disabled'] ) }}
        Masculino

    </label>


    <label class="radio-inline control-label">

        {{ Form::Radio('sexo','f', ($solicitudabstracta->SOAB_SEXO == 'f') ? true : false ,[ 'disabled' => 'disabled']) }}
        Femenino
    </label>

    <p></p>

    <div class="form-group">
        {{ Form::label('grado', 'Último grado obtenido')}}
        {{ Form::select('grado',$grado,$solicitudabstracta->SOAB_ID_GRADO, array('class'=>'form-control','style'=>'','disabled' => 'disabled'
        ))}}
    </div>

    <p></p>


    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono')}}
        {{ Form::text('telefono', $meco->MECO_TELEFONO1, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>


    <div class="form-group">
        {{ Form::label('extension', 'Extensión')}}
        {{ Form::text('extension', $meco->MECO_EXTENSION, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>

    <div class="form-group">
        {{ Form::label('telefono2', 'Otro teléfono')}}
        {{ Form::text('telefono2', $meco->MECO_TELEFONO2, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>


    <div class="form-group">
        {{ Form::label('email', 'Email')}}
        {{ Form::email('email', $meco->MECO_CORREO, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>


    <div class="form-group">


        {{ Form::label('dependencias', 'Dependencia')}}
        {{ Form::select('dependencias',$dependencias_catalogo,$solicitudabstracta->SOAB_ID_DEPENDENCIA,
        array('class'=>'form-control','style'=>'' ,'disabled' => 'disabled'))}}


    </div>

</fieldset>

<fieldset>
    <legend>Documento requeridos</legend>

    <div class="form-group">
        {{ Form::label('curriculum', 'Curriculum con produccion académica')}}


        <a href="{{action('SolicitudController@mostrarCurriculum', $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA)}}">Ver curriculum</a>
    </div>

    <div class="form-group">
        {{ Form::label('curriculum', 'Documento descriptivo')}}


        <a href="{{action('SolicitudController@mostrarDocumentoDesc', $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA)}}">Ver Documento descriptivo</a>
    </div>

    <div class="form-group">
        {{ Form::label('curriculum', 'Curriculum con produccion académica')}}


        <a href="{{action('SolicitudController@mostrarConstancia', $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA)}}">Ver constancias de adscripción</a>
    </div>

</fieldset>


<fieldset>
    <legend><h3>Recursos solicitados</h3></legend>
    <div class="row">

        <div class="col-xs-4">
            {{ Form::label('horasCPU', 'Horas  CPU')}}
            {{ Form::text('horasCPU', $solicitudabstracta->SOAB_HRS_CPU, ['class' => 'form-control','disabled' => 'disabled'])}}
        </div>


        <div class="col-xs-4">
            {{ Form::label('disco', 'Disco en GB')}}
            {{ Form::text('disco', $solicitudabstracta->SOAB_ESP_HD, ['class' => 'form-control','disabled' => 'disabled'])}}
        </div>
        <div class="col-xs-4">
            {{ Form::label('memoria', 'Memoria RAM en GB')}}
            {{ Form::text('memoria', $solicitudabstracta->SOAB_MEM_RAM, ['class' => 'form-control','disabled' => 'disabled'])}}
        </div>
    </div>

</fieldset>

<fieldset>
    <legend>Información Académica</legend>

    <div class="form-group">
        {{ Form::label('nombreproyecto', 'Nombre del proyecto')}}
        {{ Form::text('nombreproyecto', $solicitudabstracta->SOAB_NOMBRE_PROYECTO , ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>


    <div class="form-group">


        {{ Form::label('campo de trabajo', 'Campo Trabajo')}}
        {{ Form::select('campos',$campotrabajo,$solicitudabstracta->SOAB_ID_CAMPO_TRABAJO, array('class'=>'form-control','style'=>'','disabled' => 'disabled' ))}}


    </div>

    <div class="form-group">
        {{ Form::label('lineaespecialización', 'Linea de especialización')}}
        {{ Form::text('lineaesp', $solicitudabstracta->SOAB_LIN_ESPECIALIZACION, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>

    <div class="form-group">
        {{ Form::label('modelocomputacional', 'Modelo Computacional')}}
        {{ Form::text('modelocomp', $solicitudabstracta->SOAB_MOD_COMPUTACIONAL, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>



    <div class="form-group">
        {{ Form::label('otrocampo', 'Otro Campo')}}
        {{ Form::text('otrocampo', $otrocampo->OTCA_NOMBRE, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>


    <legend>Aplicaciones</legend>
    @foreach($aplicaciones as $aplicacion)
    <div class="checkbox">
        <label>

            @if(in_array($aplicacion->APLI_ID_APLICACION, $aplicacionesseleccionadas ))
            {{ Form::checkbox('aplicaciones[]', $aplicacion->APLI_ID_APLICACION, true,['disabled' => 'disabled']) }}
            @else
            {{ Form::checkbox('aplicaciones[]', $aplicacion->APLI_ID_APLICACION, false,['disabled' => 'disabled']) }}
            @endif
            {{ $aplicacion->APLI_NOMBRE}}
        </label>
    </div>
    @endforeach



    @foreach($otraapp as $otraaps)

    <div class="form-group">

        <label class="inside">Otra aplicación:</label>
        <input type="text" class="form-control clone" value="{{$otraaps->OTAP_OPCION}}" name="otraapp[{{$otraaps->OTAP_ID_OTRA_APP}}][otap_opcion]" disabled="disabled"/>

    </div>

    @endforeach

    <div class="form-group">
        {{ Form::label('Programación Paralela', 'Programación paralela')}}
    </div>

    <label class="radio-inline control-label">

        {{ Form::Radio('progparalela','1', ($solicitudabstracta->SOAB_PROG_PARALELA == '1') ? true : false ,['disabled' => 'disabled']) }}
        Sí

    </label>


    <label class="radio-inline control-label">

        {{ Form::Radio('progparalela','0', ($solicitudabstracta->SOAB_PROG_PARALELA == '0') ? true : false ,['disabled' => 'disabled']) }}
        No
    </label>


    <div class="form-group">
        {{ Form::label('numproc', 'Número estimado de procesadores por trabajo')}}
        {{ Form::text('numproc', $solicitudabstracta->SOAB_NUM_PROC_TRAB, ['class' => 'form-control','disabled' => 'disabled'])}}
    </div>

    <div class="form-group">
        {{ Form::label('dura', 'Duracion estimada por trabajo(tiempo de pared)')}}
        <select name="duracion" id="duracion" class="form-control" disabled="disabled">
            <option value="1" {{($solicitudabstracta->SOAB_DURACION == 1) ? 'selected="selected"' : false }}> 1 hora</option>
            <option value="2" {{($solicitudabstracta->SOAB_DURACION == 2) ? 'selected="selected"' :false}}> 1 a 12 horas</option>
            <option value="3" {{($solicitudabstracta->SOAB_DURACION == 3) ? 'selected="selected"': false }}> 12 a 24 horas</option>
            <option value="4"{{($solicitudabstracta->SOAB_DURACION == 4) ? 'selected="selected"' :false}}> 24 a 72 horas</option>
            <option value="5"{{($solicitudabstracta->SOAB_DURACION == 5) ? 'selected="selected"': false }}> 72 horas a 1 semanas</option>
            <option value="6"{{($solicitudabstracta->SOAB_DURACION == 6) ? 'selected="selected"' :false}}> Mas de 2 semanas</option>

        </select>
    </div>

</fieldset>

@if (empty($cuentascol))
<h2>No hay cuentas colaboradoras :(</h2>
@else

<div class="form-group">

    @foreach($cuentascol as $key => $value)

    <fieldset class="clonable">
        <legend>Detalles de la cuenta colaboradora</legend>
        <div class="form-group">
            {{ Form::label('solcol[][soco_nombres]', 'Nombre')}}
            <input class="form-control"
                   name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_nombres]" type="text"
                   value="{{$value->SOCO_NOMBRES}}"
                   id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_nombres]" disabled="disabled">
        </div>

        <div class="form-group">
            {{ Form::label('ap_pat', 'Apellido Paterno')}}
            <input class="form-control"
                   name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_paterno]" type="text"
                   value="{{$value->SOCO_AP_PATERNO}}"
                   id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_paterno]" disabled="disabled">
        </div>

        <div class="form-group">
            {{ Form::label('ap_pat', 'Apellido Materno')}}
            <input class="form-control"
                   name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_materno]" type="text"
                   value="{{$value->SOCO_AP_MATERNO}}"
                   id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_materno]" disabled="disabled">
        </div>

        <div class="form-group">
            {{ Form::label('Sexo', 'Sexo')}}
        </div>
        <div class="form-group">
            <label class="radio-inline control-label">


                <input name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_sexo]" type="radio" value="m" {{
                ($value->SOCO_SEXO == 'm') ? 'checked="checked"' : false }} disabled="disabled">
                <!--{{ Form::Radio('$radiocol','m', ($value->SOCO_SEXO == 'm') ? true : false ) }}-->
                Masculino

            </label>

            <label class="radio-inline control-label">

                <input name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_sexo]" type="radio" value="f" {{
                ($value->SOCO_SEXO == 'f') ? 'checked="checked"' : false }} disabled="disabled">
                <!--{{ Form::Radio('$radiocol','f', ($value->SOCO_SEXO == 'f') ? true : false ) }}
                -->
                Femenino
            </label>
        </div>


        <div class="form-group">

            {{ Form::label('solcol[][meco_telefono1]', 'Teléfono')}}
            <input class="form-control" name="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono1]"
                   type="text" value="{{$value->MECO_TELEFONO1}}"
                   id="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono1]" disabled="disabled">
        </div>


        <div class="form-group">

            {{ Form::label('solcol[][meco_extension]', 'Extensión')}}
            <input class="form-control" name="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_extension]"
                   type="text" value="{{$value->MECO_EXTENSION}}"
                   id="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_extension]" disabled="disabled">
        </div>


        <div class="form-group">

            {{ Form::label('solcol[][meco_telefono2]', 'Otro Teléfono')}}
            <input class="form-control" name="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono2]"
                   type="text" value="{{$value->MECO_TELEFONO2}}"
                   id="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono2]"disabled="disabled">
        </div>

        <div class="form-group">

            {{ Form::label('solcol[][meco_correo]', 'Email')}}
            <input class="form-control" name="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_correo]"
                   type="text" value="{{$value->MECO_CORREO}}"
                   id="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_correo]"disabled="disabled">
        </div>


        <div class="form-group">

            {{ Form::label('dependencias', 'Dependencia')}}
            <select class="form-control" name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_id_dependencia]" disabled="disabled">
                @foreach($dependencias_catalogo as $id => $valor)

                <option value="{{$id}}"
                {{ ($value->SOCO_ID_DEPENDENCIA == $id) ? 'selected="selected"' : false }}> {{$valor }}</option>

                @endforeach

            </select>

            {{ Form::label('ultimo grado', 'Último grado académico')}}
            <select class="form-control" name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_id_grado]" disabled="disabled">
                @foreach($grado as $id => $valor)

                <option value="{{$id}}"
                {{ ($value->SOCO_ID_GRADO == $id) ? 'selected="selected"' : false }}> {{$valor }}</option>

                @endforeach

            </select>
        </div>

    </fieldset>


    @endforeach

    @if(!empty($solicitudabstracta->SOAB_DESC_RECHAZO))
    <div class="form-group">
        {{ Form::label('', ' Comentario de denegación de recursos')}}
        {{ Form::textarea('descrechazo', $solicitudabstracta->SOAB_DESC_RECHAZO, ['class' => 'form-control', 'disabled' => 'disabled'])}}
    </div>
    @endif

    @endif


    <div class="form-group">
        <p>
            <a href="{{ URL::to('gestionarsolicitudderecursos/consultarsolicitud') }}" class="btn btn-success btn-lg">Regresar</a>
        </p>
    </div>
    {{ Form::close() }}

</div>
</div>
</div>
</div>


@endsection