@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar proyectos
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Buscar Usuarios
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row center-block">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->

                <h2>Modificar cuenta titular</h2>
                {{ Form::open (['route' => 'modificarguardarcuentatitular', 'method' => 'UPDATE','class' => 'form-horizontal', 'role' =>'form',
                'files' =>true]) }}
                <input type="hidden" name="id" value="{{ $datoscuentatitular->SOAB_ID_SOLICITUD_ABSTRACTA }}">
                <input type="hidden" name="idusuario" value="{{ $datoscuentatitular->USUA_ID_USUARIO }}">
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
                        {{ Form::text('nombre', $datoscuentatitular->SOAB_NOMBRES , ['class' => 'form-control'])}}
                        @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
                    </div>

                    <div class="form-group">
                        {{ Form::label('apellidoPaterno', 'Apellido Paterno')}}
                        {{ Form::text('apellidoPaterno', $datoscuentatitular->SOAB_AP_PATERNO, ['class' =>
                        'form-control'])}}
                    </div>


                    <div class="form-group">
                        {{ Form::label('apellidoMaterno', 'Apellido Materno')}}
                        {{ Form::text('apellidoMaterno', $datoscuentatitular->SOAB_AP_MATERNO, ['class' =>
                        'form-control'])}}
                    </div>


                    <div class="form-group">
                        {{ Form::label('Sexo', 'Sexo')}}
                    </div>
                    <label class="radio-inline control-label">

                        {{ Form::Radio('sexo','m', ($datoscuentatitular->SOAB_SEXO == 'm') ? true : false ) }}
                        Masculino

                    </label>


                    <label class="radio-inline control-label">

                        {{ Form::Radio('sexo','f', ($datoscuentatitular->SOAB_SEXO == 'f') ? true : false ) }}
                        Femenino
                    </label>

                    <p></p>

                    <div class="form-group">
                        {{ Form::label('grado', 'Último grado obtenido')}}
                        {{ Form::select('grado',$grado,$datoscuentatitular->SOAB_ID_GRADO,
                        array('class'=>'form-control','style'=>''
                        ))}}
                    </div>

                    <p></p>


                    <div class="form-group">
                        {{ Form::label('telefono', 'Teléfono')}}
                        {{ Form::text('telefono', $datoscuentatitular->MECO_TELEFONO1, ['class' => 'form-control'])}}
                    </div>


                    <div class="form-group">
                        {{ Form::label('extension', 'Extensión')}}
                        {{ Form::text('extension', $datoscuentatitular->MECO_EXTENSION, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('telefono2', 'Otro teléfono')}}
                        {{ Form::text('telefono2', $datoscuentatitular->MECO_TELEFONO2, ['class' => 'form-control'])}}
                    </div>


                    <div class="form-group">
                        {{ Form::label('email', 'Email')}}
                        {{ Form::email('email', $datoscuentatitular->MECO_CORREO, ['class' => 'form-control'])}}
                    </div>


                    <div class="form-group">


                        {{ Form::label('dependencias', 'Dependencias')}}
                        {{ Form::select('dependencias',$dependencias_catalogo,$datoscuentatitular->SOAB_ID_DEPENDENCIA,
                        array('class'=>'form-control','style'=>'' ))}}


                    </div>

                </fieldset>

                <fieldset>
                    <legend>Documento requeridos</legend>
                    <div class="well">ATENCIÓN: Le recordamos que la documentación debe ser enviada en formato .pdf y el
                        tamaño del
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
                        {{ Form::label('constancias', 'Constancia de Adscripción a la dependencia(de todas las cuentas
                        solicitadas)')}}
                        {{Form::file('constancias');}}

                    </div>

                    <div class="form-group">
                        <p>
                            <input type="submit" value="Guardar" class="btn btn-success btn-lg">
                        </p>
                    </div>
                </fieldset>
                {{ Form::close() }}
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection