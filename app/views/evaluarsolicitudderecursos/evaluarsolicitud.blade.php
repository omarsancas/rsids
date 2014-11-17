

@extends('dashboardlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Evaluar Solicitud de Recursos
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Evaluar Solicitud de Recursos
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('generar' ), 'id' => 'idForm')) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Evaluar Solicitud de Recursos</h2>



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
                            <td> {{$solicitud->SOAB_NOMBRES}} {{$solicitud->SOAB_AP_PATERNO}} {{$solicitud->SOAB_AP_MATERNO</td>
                            <td> {{$solicitud->TISO_NOMBRE}}</td>
                            <td>
                                <a href="{{ action('EvaluarSolicitudController@aceptar', $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA) }}" class="btn btn-success">Aceptar</a>

                                <a href="{{ action('EvaluarSolicitudController@rechazar', $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA) }}" class="btn btn-danger">Rechazar</a>

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
