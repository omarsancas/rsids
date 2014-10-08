@extends('layout')

@section('content')
<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">This Page is Disabled</div>
        <div class="panel-body">
            <div class="col-md-6">


                <h1></h1>

                <h1>Modificar solicitud de recursos</h1>
                {{ Form::open (['route' => 'update', 'method' => 'UPDATE','class' => 'form-horizontal', 'role' =>
                'form', 'files' =>true]) }}
                <input type="hidden" name="id" value="{{ $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA }}">

                @if ($errors)
                <div class="alert">
                    <p style="color:red;">
                        {{ implode('', $errors->all('<li>:message</li>')) }}
                    </p>
                </div>
                @endif

                <fieldset>
                    <legend>Datos generales del titular</legend>

                    <div class="form-group">
                        {{ Form::label('nombre', 'Nombre')}}
                        {{ Form::text('nombre', $solicitudabstracta->SOAB_NOMBRES , ['class' => 'form-control'])}}
                        @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
                    </div>

                    <div class="form-group">
                        {{ Form::label('apellidoPaterno', 'Apellido Paterno')}}
                        {{ Form::text('apellidoPaterno', $solicitudabstracta->SOAB_AP_PATERNO, ['class' => 'form-control'])}}
                    </div>


                    <div class="form-group">
                        {{ Form::label('apellidoMaterno', 'Apellido Materno')}}
                        {{ Form::text('apellidoMaterno', $solicitudabstracta->SOAB_AP_MATERNO, ['class' => 'form-control'])}}
                    </div>


                    <div class="form-group">
                        {{ Form::label('Sexo', 'Sexo')}}
                    </div>
                    <label class="radio-inline control-label">





                        {{ Form::Radio('sexo','Masculino', ($solicitudabstracta->SOAB_SEXO == 'm') ? true : false ) }}
                        Masculino

                    </label>


                    <label class="radio-inline control-label">

                        {{ Form::Radio('sexo','Femenino', ($solicitudabstracta->SOAB_SEXO == 'f') ? true : false ) }}
                        Femenino
                    </label>

                    <p></p>

                    <div class="form-group">
                        {{ Form::label('grado', 'Último grado obtenido')}}
                        {{ Form::select('grado',$grado,$solicitudabstracta->SOAB_ID_GRADO, array('class'=>'form-control','style'=>'' ))}}
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
                        {{ Form::select('dependencias',$dependencias_catalogo,$solicitudabstracta->SOAB_ID_DEPENDENCIA, array('class'=>'form-control','style'=>'' ))}}


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
                        @if ($errors->has('pdf1')) <p class="help-block">{{ $errors->first('pdf1') }}</p> @endif
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
                        <textarea id="descproyecto" name="descproyecto" class="form-control" rows="3"></textarea>
                    </div>





                    <div class="form-group">
                        {{ Form::label('lineaespecialización', 'Linea de especialización')}}
                        {{ Form::text('lineaesp', '', ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('modelocomputacional', 'Modelo Computacional')}}
                        {{ Form::text('modelocomp', '', ['class' => 'form-control'])}}
                    </div>


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
                               id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_nombres]">
                    </div>

                    <div class="form-group">
                        {{ Form::label('ap_pat', 'Apellido Paterno')}}
                        <input class="form-control"
                               name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_paterno]" type="text"
                               value="{{$value->SOCO_AP_PATERNO}}"
                               id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_paterno]">
                    </div>

                    <div class="form-group">
                        {{ Form::label('ap_pat', 'Apellido Materno')}}
                        <input class="form-control"
                               name="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_materno]" type="text"
                               value="{{$value->SOCO_AP_MATERNO}}"
                               id="solcol[{{$value->SOCO_ID_SOLICITUD_COLABORADORA}}][soco_ap_materno]">
                    </div>




                    <div class="form-group">

                        {{ Form::label('solcol[][soco_nombres]', 'Telefono')}}
                        <input class="form-control" name="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono1]"
                               type="text" value="{{$value->MECO_TELEFONO1}}"
                               id="meco[{{$value->MECO_ID_MEDIO_COMUNICACION}}][meco_telefono1]">
                    </div>

                     </fieldset>


                    @endforeach

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


    @endsection