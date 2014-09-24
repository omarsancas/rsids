@extends('layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->


<div class="container">

<div class="panel panel-default">
<div class="panel-heading">This Page is Disabled</div>
<div class="panel-body">
<div class="col-md-6">


<h1></h1>

<h1>Solicitud de recursos </h1>

{{ Form::open (['route' => 'registrar', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form', 'files' =>true]) }}

<fieldset>
    <legend>Datos generales del titular</legend>

    <div class="form-group">
        {{ Form::label('nombre', 'Nombre')}}
        {{ Form::text('nombre', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('apellidoPaterno', 'Apellido Paterno')}}
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

    <p></p>


    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono')}}
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
        {{ Form::label('email', 'Email')}}
        {{ Form::email('email', '', ['class' => 'form-control'])}}
    </div>


    <div class="form-group">


        {{ Form::label('dependencias', 'Dependencias')}}
        {{ Form::select('dependencias',$dependencias_catalogo,null, array('class'=>'form-control','style'=>'' ))}}


    </div>

</fieldset>

<fieldset>
    <legend>Documento requeridos</legend>
    <div class="well">ATENCIÓN: Le recordamos que la documentación debe ser enviada en formato .pdf y el tamaño del
        archivo no debe sobrepasar los 8 MB
    </div>
    <div class="form-group">
        {{ Form::label('curriculum', 'Curriculum con produccion académica')}}

        {{Form::file('pdf1');}}
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
        {{ Form::text('nombreproyecto', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('descproyecto', 'Descripción del proyecto')}}
        <textarea id="descproyecto" class="form-control" rows="3"></textarea>
    </div>





    <div class="form-group">
        {{ Form::label('lineaespecialización', 'Linea de especialización')}}
        {{ Form::text('lineaesp', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('modelocomputacional', 'Modelo Computacional')}}
        {{ Form::text('modelocomp', '', ['class' => 'form-control'])}}
    </div>

    <label for="name">Aplicaciones </label>

    <div class="row">
        <div class="col-lg-6">

            @foreach ($aplicaciones as $key=>$aplicacion)
            @if($key>0)
            <label class="checkbox-inline">
                <input type="checkbox" name="aplicaciones[]" value="{{$key}}"> <label> {{$aplicacion}} </label>
            </label>
            @endif
            @endforeach
            <input type="hidden" name="aplicaciones[1]" value="0"/>


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

        <input type="radio" name="progparalela" id="progparalela" value="0" checked>
        Sí
    </label>


    <label class="radio-inline control-label">
        <input type="radio" name="progparalela" id="progparalela" value="1">
        No
    </label>


    <div class="form-group">
        {{ Form::label('numproc', 'Número estimado de procesadores por trabajo')}}
        {{ Form::text('numproc', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{ Form::label('dura', 'Duracion estimada por trabajo(tiempo de pared)')}}
        <select name="duracion" id="duracion" class="form-control">
            <option value="1"> 1 hora </option>
            <option value="2">mayor o igual a dos semanas</option>
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


                {{ Form::label('dependencias', 'Dependencias')}}

                {{ Form::select('solcol[0][soco_id_dependencia]', $dependencias_catalogo)}}

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