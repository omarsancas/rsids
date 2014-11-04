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
                        <i class="fa fa-table"></i> Generar carta de aceptación solicitud de recursos
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('aceptar' ), 'id' => 'idForm')) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Generar carta de aceptación de recursos</h2>



                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de la solicitud</th>
                            <th>Nombre Completo del proyecto</th>
                            <th>Nombre del titular del proyecto</th>
                            <th>Tipo de solicitud</th>
                            <th>Acción</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($solicitudes as $solicitud)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}</td>
                            <td> {{$solicitud->SOAB_NOMBRE_PROYECTO}}</td>
                            <td> {{$solicitud->SOAB_NOMBRES}}</td>
                            <td> {{$solicitud->TISO_NOMBRE}}</td>
                            <td>
                                <a href="{{ action('SolicitudController@generarCartas', $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA) }}" class="btn btn-success">Generar Carta de aceptación</a>


                            </td>


                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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