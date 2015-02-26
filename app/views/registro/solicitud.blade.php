@extends('layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->


<div class="container">

<div class="panel panel-default">
<div class="panel-heading">This Page is Disabled</div>
<div class="panel-body">
<div class="col-md-6">


<h1></h1>

<h1> Generar solicitud de recursos </h1>

{{ Form::open (['route' => 'registrar', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form', 'files' =>true]) }}


@if ($errors)


    <ul class="list-group">

        {{ implode('', $errors->all('<li class="list-group-item list-group-item-danger">:message</li>')) }}

    </ul>




@endif

<fieldset>
    <legend>Datos generales del titular</legend>

    <div class="form-group">
        {{ Form::label('nombre', 'Nombre(s)(*)')}}
        {{ Form::text('nombre', Input::old('nombre') , ['class' => 'form-control'])}}
        @if ($errors->has('nombre')) <li class="list-group-item list-group-item-danger">{{ $errors->first('nombre') }}</li> @endif
    </div>

    <div class="form-group">
        {{ Form::label('apellidoPaterno', 'Apellido Paterno(*)')}}
        {{ Form::text('apellidoPaterno', '', ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('apellidoMaterno', 'Apellido Materno')}}
        {{ Form::text('apellidoMaterno', '', ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('Sexo', 'Sexo')}}
    </div>
    <label class="radio-inline control-label">

        <input type="radio" name="sexo" id="sexo" value="m" checked>
        Masculino
    </label>


    <label class="radio-inline control-label">
        <input type="radio" name="sexo" id="sexo" value="f">
        Femenino
    </label>

    <p></p>

    <div class="form-group">
        {{ Form::label('grado', 'Último grado obtenido')}}
        {{ Form::select('grado',$grado,null, array('class'=>'form-control','style'=>'' ))}}
    </div>


    <div class="form-group">
        {{ Form::label('grado', 'Dependencia')}}
        {{ Form::select('dependencias',$dependencias_catalogo,null, array('class'=>'form-control','style'=>'' ))}}
    </div>

    <p></p>


    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono(*)')}}
        {{ Form::text('telefono', '', ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('extension', 'Extensión')}}
        {{ Form::text('extension', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('telefono2', 'Otro teléfono')}}
        {{ Form::text('telefono2', '', ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('email', 'Email(*)')}}
        {{ Form::email('email', '', ['class' => 'form-control'])}}
    </div>





</fieldset>

<fieldset>
    <legend>Documentos requeridos</legend>
    <div class="well">ATENCIÓN: Le recordamos que la documentación debe ser enviada en formato .pdf y el tamaño del
        archivo no debe sobrepasar los 8 MB
    </div>
    <div class="form-group">
        {{ Form::label('curriculum', 'Curriculum con produccion académica(*)')}}

        {{Form::file('curriculum');}}
        @if ($errors->has('curriculum')) <p class="help-block">{{ $errors->first('curriculum') }}</p> @endif
    </div>


    <div class="form-group">
        {{ Form::label('docdesc', 'Documento descriptivo del trabajo a realizar(*)')}}

        {{Form::file('documentodescriptivo');}}
        {{ $errors->first('documentodescriptivo','<span class="error">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::label('constancias', 'Constancia de Adscripción a la dependencia(de todas las cuentas solicitadas')}}

        {{Form::file('constancias');}}
        {{ $errors->first('constancias','<p class="help-block">:message</p>') }}
    </div>

</fieldset>


<fieldset>
    <legend><h3>Recursos solicitados</h3></legend>
    <div class="row">

        <div class="col-xs-4">
            {{ Form::label('horasCPU', 'Horas CPU(*)')}}
            {{ Form::text('horasCPU', '', ['class' => 'form-control' , 'data-placement'=>'top' , 'title' =>'Las horas CPU'])}}
        </div>


        <div class="col-xs-4">
            {{ Form::label('disco', 'Disco en GB')}}
            {{ Form::text('disco', '', ['class' => 'form-control' , 'data-placement'=>'top' , 'title' =>'Disco en GB'])}}
        </div>
        <div class="col-xs-4">
            {{ Form::label('memoria', 'Memoria RAM en GB')}}
            {{ Form::text('memoria', '', ['class' => 'form-control', 'data-placement'=>'top' , 'title' =>'Memoria en Gb'])}}
        </div>
    </div>

</fieldset>

<fieldset>
    <legend>Información Académica</legend>

    <div class="form-group">
        {{ Form::label('nombreproyecto', 'Nombre del proyecto(*)')}}
        {{ Form::text('nombreproyecto', '', ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('campo de trabajo', 'Campo Trabajo')}}
        {{ Form::select('campos',$campos,null, array('class'=>'form-control','style'=>'' ))}}
    </div>


    <div class="form-group">
        {{ Form::label('lineaespecialización', 'Linea de especialización(*)')}}
        {{ Form::text('lineaesp', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('modelocomputacional', 'Modelo Computacional(*)')}}
        {{ Form::text('modelocomp', '', ['class' => 'form-control'])}}
    </div>


    <div class="form-group">
        {{ Form::label('otrocampo', 'Otro Campo')}}
        {{ Form::text('otrocampo', '', ['class' => 'form-control'])}}
    </div>


    <label for="name">Aplicaciones </label>

    <div class="row">
        <div class="col-lg-6">

            @foreach ($aplicaciones as $key=>$aplicacion)
            @if($key>1)
            <label class="checkbox-inline">
                <input type="checkbox" name="aplicaciones[]" value="{{$key}}"> <label> {{$aplicacion}} </label>
            </label>
            @endif
            @endforeach
            <input type="hidden" name="aplicaciones[]" value="1"/>


        </div>
    </div>

    <div class="form-group">

        <div hidden>
            <fieldset class="clonableapp">

                <div class="regrow">
                    <div class="regrow">
                        <label class="inside">Otra aplicación:</label>
                        <input type="text" class="form-control clone" name="otraapp[0][otap_opcion]"/>
                    </div>
                </div>
                <a href="#" class="btn btn-danger btn-sm removeapp">Eliminar aplicación</a>

                <div class="row spacer">
                    <div class="span4">.</div>

                </div>
            </fieldset>

        </div>


        <div class="well">Si tu aplicación no se encuentra registrada puedes agregar mas aplicaciones</div>

        <div id="formbuttonsapp" class="regrow">
            <a href="#" class="btn btn-primary" id="clonetriggerapp">Agregar aplicación</a>

        </div>
    </div>

    <div class="form-group">
        {{ Form::label('Programación Paralela', 'Programación paralela')}}
    </div>
    <label class="radio-inline control-label">

        <input type="radio" name="progparalela" id="progparalela" value="1" checked>
        Sí
    </label>


    <label class="radio-inline control-label">
        <input type="radio" name="progparalela" id="progparalela" value="0">
        No
    </label>


    <div class="form-group">
        {{ Form::label('numproc', 'Número estimado de procesadores por trabajo')}}
        {{ Form::text('numproc', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('dura', 'Duracion estimada por trabajo(tiempo de pared)')}}
        <select name="duracion" id="duracion" class="form-control">
            <option value="1" > 1 hora</option>
            <option value="2" > 1 a 12 horas</option>
            <option value="3" > 12 a 24 horas</option>
            <option value="4"> 24 a 72 horas</option>
            <option value="5"> 72 horas a 1 semanas</option>
            <option value="6"> Mas de 2 semanas</option>

        </select>
    </div>





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
        <legend>Cuentas colaboradoras</legend>
        <div id="formbuttons" class="regrow">
            <a href="#" class="btn btn-primary" id="clonetrigger">Agregar Cuentas colaboradora</a>

        </div>
    </fieldset>


</div>

<!--
{{ Form::text('solcol[0][soco_nombres]',null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[0][soco_ap_paterno]', null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[0][soco_ap_materno]',null, array('class' => 'form-control clone'))}}

{{ Form::text('solcol[1][soco_nombres]',null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[1][soco_ap_paterno]', null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[1][soco_ap_materno]',null, array('class' => 'form-control clone'))}}

{{ Form::text('solcol[2][soco_nombres]',null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[2][soco_ap_paterno]', null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[2][soco_ap_materno]',null, array('class' => 'form-control clone'))}}

{{ Form::text('solcol[4][soco_nombres]',null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[4][soco_ap_paterno]', null, array('class' => 'form-control clone'))}}
{{ Form::text('solcol[4][soco_ap_materno]',null, array('class' => 'form-control clone'))}}
-->


<!-- Este div es para clonar las solicitudes cuenta colaboradora-->


<p>


</p>


<p>


</p>


<p>


</p>

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

@endsection