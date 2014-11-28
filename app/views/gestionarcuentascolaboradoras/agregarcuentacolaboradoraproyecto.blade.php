@extends('dashboardlayout')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Cuentas Colaboradoras
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Agregar Cuenta Colaboradora
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'cambiarestadoproyecto', 'method' => 'POST','class' => 'form-horizontal',
                'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Agregar Cuenta Colaboradora</h2>


                <div class="form-group">
                    {{ Form::label('nom', 'Nombre(s)')}}
                    {{ Form::text('q', null , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('apellidopat','Apellido Paterno')}}
                    {{ Form::text('apellidopaterno',null,['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('apellidomat','Apellido Materno')}}
                    {{ Form::text('apelidomaterno',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('telefono','Teléfono')}}
                    {{ Form::text('telefono',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('extension','Extension')}}
                    {{ Form::text('extension', null ,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('otrotelefono','Otro Teléfono')}}
                    {{ Form::text('otro telefono', null ,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('email','Email')}}
                    {{ Form::text('email',,['class'=>'form-control'])}}
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

                <div class="form-group">
                    {{ Form::label('grado', 'Último grado obtenido')}}
                    {{ Form::select('grado',$grado,null, array('class'=>'form-control','style'=>'' ))}}
                </div>

                <div class="form-group">
                    {{ Form::label('dependencias', 'Dependencia')}}
                    {{ Form::select('dependencias',$dependencias_catalogo,null, array('class'=>'form-control','style'=>'' ))}}

                </div>



                <div class="form-group">
                    <p>
                        <input type="submit" value="Agregar cuenta colaboradora" class="btn btn-success btn-lg">
                    </p>
                </div>

                {{ Form::close() }}
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection