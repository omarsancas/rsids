@extends('dashboardlayout')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Solicitud de Recursos
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Notificar Aprobacion de Recursos
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('notificar' ), 'id' => 'idForm')) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Notificar Aprobación de Recursos</h2>


                @if(empty($solicitudes))
                <h2>No hay solicitudes que notificar</h2>
                @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de la solicitud</th>
                            <th>Nombre Completo del proyecto</th>
                            <th>Nombre del titular del proyecto</th>
                            <th>Email</th>
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
                            <td> {{$solicitud->MECO_CORREO}}</td>
                            <td> {{$solicitud->TISO_NOMBRE}}</td>
                            <td>
                                <a href="{{ action('SolicitudController@notificarAprobacion', $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA) }}" class="btn btn-success">Notificar aprobación de recursos</a>


                            </td>


                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                {{ Form::close() }}
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection