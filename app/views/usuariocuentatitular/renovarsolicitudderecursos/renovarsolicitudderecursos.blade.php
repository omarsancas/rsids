@extends('layout')

@section('content')
<div class="container">

<div class="panel panel-default">
<div class="panel-heading">This Page is Disabled</div>
<div class="panel-body">
<div class="col-md-6">


<h1></h1>

<h1>Renovar solicitud de recursos</h1>
@if($date < 1)

<h1>Todavia no puede renovar sus recursos hasta la fecha {{ $datosrenovacion->PROY_FEC_TERM_RECU }}</h1>

@else
{{ Form::open (['route' => 'renovarsolicitud', 'method' => 'UPDATE','class' => 'form-horizontal', 'role' =>'form', 'files' =>true]) }}
<input type="hidden" name="id" value="{{ $datosrenovacion->SOAB_ID_SOLICITUD_ABSTRACTA }}">
<input type="hidden" name="idmeco" value="{{ $datosrenovacion->MECO_ID_MEDIO_COMUNICACION }}">
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
        {{ Form::text('nombre', $datosrenovacion->SOAB_NOMBRES , ['class' => 'form-control'])}}
        @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
    </div>

    <div class="form-group">
        {{ Form::label('apellidoPaterno', 'Apellido Paterno')}}
        {{ Form::text('apellidoPaterno', $datosrenovacion->SOAB_AP_PATERNO, ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('apellidoMaterno', 'Apellido Materno')}}
        {{ Form::text('apellidoMaterno', $datosrenovacion->SOAB_AP_MATERNO, ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('Sexo', 'Sexo')}}
    </div>
    <label class="radio-inline control-label">

        {{ Form::Radio('sexo','m', ($datosrenovacion->SOAB_SEXO == 'm') ? true : false ) }}
        Masculino

    </label>


    <label class="radio-inline control-label">

        {{ Form::Radio('sexo','f', ($datosrenovacion->SOAB_SEXO == 'f') ? true : false ) }}
        Femenino
    </label>

    <p></p>

    <div class="form-group">
        {{ Form::label('grado', 'Último grado obtenido')}}
        {{ Form::select('grado',$grado,$datosrenovacion->SOAB_ID_GRADO, array('class'=>'form-control','style'=>''
        ))}}
    </div>

    <p></p>


    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono')}}
        {{ Form::text('telefono', $datosrenovacion->MECO_TELEFONO1, ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('extension', 'Extensión')}}
        {{ Form::text('extension', $datosrenovacion->MECO_EXTENSION, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('telefono2', 'Otro teléfono')}}
        {{ Form::text('telefono2', $datosrenovacion->MECO_TELEFONO2, ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('email', 'Email')}}
        {{ Form::email('email', $datosrenovacion->MECO_CORREO, ['class' => 'form-control'])}}
    </div>


    <div class="form-group">


        {{ Form::label('dependencias', 'Dependencias')}}
        {{ Form::select('dependencias',$dependencias_catalogo,$datosrenovacion->SOAB_ID_DEPENDENCIA,
        array('class'=>'form-control','style'=>'' ))}}


    </div>

</fieldset>

<fieldset>
    <legend>Documento requeridos</legend>
    <div class="well">ATENCIÓN: Le recordamos que la documentación debe ser enviada en formato .pdf y el tamaño del
        archivo no debe sobrepasar los 8 MB
    </div>
    <div class="form-group">
        {{ Form::label('curriculum', 'Curriculum con produccion académica')}}
        {{Form::file('curriculum');}}

    </div>

    <div class="form-group">
        {{ Form::label('docdesc', 'Documento descriptivo del trabajo a realizar')}}
        {{Form::file('docdesc');}}

    </div>

    <div class="form-group">
        {{ Form::label('constancias', 'Constancia de Adscripción a la dependencia(de todas las cuentas solicitadas)')}}
        {{Form::file('constancias');}}

    </div>

</fieldset>


<fieldset>
    <legend><h3>Recursos solicitados</h3></legend>
    <div class="row">

        <div class="col-xs-3">
            {{ Form::label('horasCPU', 'Horas en CPU')}}
            {{ Form::text('horasCPU', '', ['class' => 'form-control'])}}
        </div>


        <div class="col-xs-3">
            {{ Form::label('disco', 'Disco en GB')}}
            {{ Form::text('disco', '', ['class' => 'form-control'])}}
        </div>
        <div class="col-xs-3">
            {{ Form::label('memoria', 'Memoria en GB')}}
            {{ Form::text('memoria', '', ['class' => 'form-control'])}}
        </div>
    </div>

</fieldset>

<fieldset>
    <legend>Información Académica</legend>

    <div class="form-group">
        {{ Form::label('nombreproyecto', 'Nombre del proyecto')}}
        {{ Form::text('nombreproyecto', $datosrenovacion->SOAB_NOMBRE_PROYECTO , ['class' => 'form-control'])}}
    </div>




    <div class="form-group">
        {{ Form::label('lineaespecialización', 'Linea de especialización')}}
        {{ Form::text('lineaesp', $datosrenovacion->SOAB_LIN_ESPECIALIZACION, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('modelocomputacional', 'Modelo Computacional')}}
        {{ Form::text('modelocomp', $datosrenovacion->SOAB_MOD_COMPUTACIONAL, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">


        {{ Form::label('campo de trabajo', 'Campo Trabajo')}}
        {{ Form::select('campos',$campotrabajo,$datosrenovacion->SOAB_ID_CAMPO_TRABAJO, array('class'=>'form-control','style'=>'' ))}}


    </div>

    <div class="form-group">
        {{ Form::label('otrocampo', 'Otro Campo')}}
        {{ Form::text('otrocampo', $otrocampo->OTCA_NOMBRE, ['class' => 'form-control'])}}
    </div>


    <legend>Aplicaciones</legend>
    @foreach($aplicaciones as $aplicacion)
    <div class="checkbox">
        <label>

            @if(in_array($aplicacion->APLI_ID_APLICACION, $aplicacionesseleccionadas ))
            {{ Form::checkbox('aplicaciones[]', $aplicacion->APLI_ID_APLICACION, true) }}
            @else
            {{ Form::checkbox('aplicaciones[]', $aplicacion->APLI_ID_APLICACION, false) }}
            @endif
            {{ $aplicacion->APLI_NOMBRE}}
        </label>
    </div>
    @endforeach



    @foreach($otraapp as $otraaps)

    <div class="form-group">

        <label class="inside">Otra aplicación:</label>
        <input type="text" class="form-control clone" value="{{$otraaps->OTAP_OPCION}}" name="otraapp[{{$otraaps->OTAP_ID_OTRA_APP}}][otap_opcion]"/>

    </div>


    @endforeach

    <div class="form-group">
        {{ Form::label('Programación Paralela', 'Programación paralela')}}
    </div>

    <label class="radio-inline control-label">

        {{ Form::Radio('progparalela','1', ($datosrenovacion->SOAB_PROG_PARALELA == '1') ? true : false ) }}
        Sí

    </label>


    <label class="radio-inline control-label">

        {{ Form::Radio('progparalela','0', ($datosrenovacion->SOAB_PROG_PARALELA == '0') ? true : false ) }}
        No
    </label>


    <div class="form-group">
        {{ Form::label('numproc', 'Número estimado de procesadores por trabajo')}}
        {{ Form::text('numproc', $datosrenovacion->SOAB_NUM_PROC_TRAB, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('dura', 'Duracion estimada por trabajo(tiempo de pared)')}}
        <select name="duracion" id="duracion" class="form-control">
            <option value="1" {{($datosrenovacion->SOAB_DURACION == 1) ? 'selected="selected"' : false }}> 1 hora</option>
            <option value="2" {{($datosrenovacion->SOAB_DURACION == 2) ? 'selected="selected"' :false}}> 1 a 12 horas</option>
            <option value="3" {{($datosrenovacion->SOAB_DURACION == 3) ? 'selected="selected"': false }}> 12 a 24 horas</option>
            <option value="4"{{($datosrenovacion->SOAB_DURACION == 4) ? 'selected="selected"' :false}}> 24 a 72 horas</option>
            <option value="5"{{($datosrenovacion->SOAB_DURACION == 5) ? 'selected="selected"': false }}> 72 horas a 1 semanas</option>
            <option value="6"{{($datosrenovacion->SOAB_DURACION == 6) ? 'selected="selected"' :false}}> Mas de 2 semanas</option>

        </select>
    </div>

</fieldset>

@if (empty($cuentascolaboradoras))
<h2>No hay cuentas colaboradoras :(</h2>
@else

<div class="form-group">
    <fieldset>
        <legend>Cuentas colaboradoras actuales</legend>
    @foreach($cuentascolaboradoras as $key => $value)


        <div class="form-group">
            <label for="nombre">Login cuenta colaboradora de {{ $value->USUA_NOM_COMPLETO }}</label>
            <input class="form-control"
                   name="cuentascol[{{$value->USUA_ID_USUARIO}}][usua_id_usuario]" type="text"
                   value="{{$value->USUA_ID_USUARIO}}"
                   id="cuentascol[{{$value->USUA_ID_USUARIO}}][usua_id_usuario]" disabled>
        </div>

        <div class="form-group">
            <label for="nombre"> Estado de la cuenta</label>
                <select class="form-control" name="cuentascol[{{$value->USUA_ID_USUARIO}}]">
                    @foreach($estadousuario as $id => $valor)
                    <option value="{{$id}}"
                    {{ ($value->USUA_ID_ESTADO_USUARIO == $id) ? 'selected="selected"' : false }} > {{$valor }}</option>

                    @endforeach

                </select>
            </div>





    @endforeach

    </fieldset>


    <div class="form-group">
        <div hidden>
            <fieldset class="clonable">
                <legend>Detalles de la cuenta</legend>
                <div class="regrow">
                    <div class="regrow">
                        <label class="inside">Nombre(s):</label>
                        <input type="text" class="form-control clone" name="solcol[0][soco_nombres]" maxlength="30"/>
                    </div>
                    <div class="regrow">
                        <label class="inside">Apellido Paterno:</label>
                        <input type="text" class="form-control clone" name="solcol[0][soco_ap_paterno]" maxlength="30"/>
                    </div>
                    <div class="regrow">
                        <label class="inside">Apellido materno</label>
                        <input type="text" class="form-control clone" name="solcol[0][soco_ap_materno]" maxlength="30"/>
                    </div>


                    {{ Form::label('Sexo', 'Sexo')}}

                    <label class="radio-inline control-label">

                        <input type="radio" name="solcol[0][soco_sexo]" id="sexo" value="m" checked>
                        Masculino
                    </label>


                    <label class="radio-inline control-label">
                        <input type="radio" name="solcol[0][soco_sexo]" id="sexo" value="f">
                        Femenino
                    </label>





                    <div class="regrow">
                        <label class="inside">Teléfono</label>
                        <input type="text" class="form-control clone" name="meco[0][meco_telefono1]" maxlength="30"/>
                    </div>

                    <div class="regrow">
                        <label class="inside">Extensión</label>
                        <input type="text" class="form-control clone" name="meco[0][meco_extension]" maxlength="30"/>
                    </div>

                    <div class="regrow">
                        <label class="inside">Otro Teléfono</label>
                        <input type="text" class="form-control clone" name="meco[0][meco_telefono2]" maxlength="30"/>
                    </div>

                    <div class="regrow">
                        <label class="inside">Email</label>
                        <input type="text" class="form-control clone" name="meco[0][meco_correo]" maxlength="30"/>
                    </div>


                    {{ Form::label('dependencias', 'Dependencia')}}
                    {{ Form::select('solcol[0][soco_id_dependencia]', $dependencias_catalogo, null,array('class'=>'form-control','style'=>'' ) )}}

                    {{ Form::label('grado', 'Último grado obtenido')}}
                    {{ Form::select('solcol[0][soco_id_grado]', $grado, null, array('class'=>'form-control','style'=>'' ))}}

                </div>
                <a href="#" class="btn btn-danger btn-sm remove">Eliminar usuario</a>

                <div class="row spacer">
                    <div class="span4">.</div>
                    <div class="span4">.</div>
                    <div class="span4">.</div>
                </div>
            </fieldset>
        </div>
        &nbsp;
        &nbsp;
        &nbsp;
        <fieldset>
            <legend>¿Deseas agregar cuentas colaboradoras?</legend>
            <div id="formbuttons" class="regrow">
                <a href="#" class="btn btn-primary" id="clonetrigger">Agregar Cuentas colaboradora</a>

            </div>
        </fieldset>


    </div>



    <div class="form-group">
        {{ Form::label('curriculum', 'Artículo Indizado')}}
        {{Form::file('articuloin');}}

    </div>




    @endif



    <div class="form-group">
        <p>
            <input type="submit" value="Enviar" class="btn btn-success btn-lg">
        </p>
    </div>
    {{ Form::close() }}

</div>
</div>
</div>
</div>

@endif


@endsection