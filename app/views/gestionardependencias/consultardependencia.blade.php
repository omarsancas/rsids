@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Solicitud de recursos
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Modificar dependencia
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'modificardependencia', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Dar de alta una dependencia</h2>

                <input type="hidden" name="id" value="{{ $dependencia->DEPE_ID_DEPENDENCIA }}">
                <div class="form-group">
                    {{ Form::label('nombre completo', 'Nombre completo de la dependencia')}}
                    {{ Form::text('nombredependencia', $dependencia->DEPE_NOMBRE , ['class' => 'form-control','disabled' => 'disabled'])}}

                </div>


                <div class="form-group">
                    {{ Form::label('acrp', 'Acrónimo')}}
                    {{ Form::text('acronimo', $dependencia->DEPE_ACRONIMO , ['class' => 'form-control','disabled' => 'disabled'])}}

                </div>

                <div class="form-group">
                    {{ Form::label('tipo', 'Tipo de dependencia')}}
                    {{ Form::select('tipodependencia',$tipodependencia,$dependencia->DEPE_ID_TIPO_DEPENDENCIA, array('class'=>'form-control','style'=>'','disabled' => 'disabled'
                    ))}}
                </div>






                <div class="form-group">
                    <p>

                        <a href="{{ URL::to('gestionardependencias/consultardependenciasvista') }}">Regresar</a>
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