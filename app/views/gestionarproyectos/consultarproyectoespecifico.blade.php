
@extends('dashboardlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Proyectos
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar un Proyecto
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-10">

                <div class="jumbotron">
                    <h2>Número proyecto: {{$reportesproyectodatos->proy_id_proyecto}}</h2>
                    <h2>Nombre del proyecto: {{$reportesproyectodatos->proy_nombre}}</h2>
                    <h2>Estado del proyecto: {{$reportesproyectodatos->espr_tipo_estado}}</h2>
                    <h2>Fecha de inicio de recursos: {{$reportesproyectodatos->proy_fec_ini_recu}}</h2>
                    <h2>Fecha de termino de recursos: {{$reportesproyectodatos->proy_fec_term_recu}}</h2>
                    <h2>Fecha de ultimo cambio de estado: {{$reportesproyectodatos->proy_fec_cambio_est}}</h2>
                    <h2>Fecha de termino de reanudación de estado: {{$reportesproyectodatos->proy_fec_reanud_est}}</h2>
                    <h2>Fecha de registro del proyecto: {{$reportesproyectodatos->proy_fecha_registro}}</h2>
                    <h2>Nombre de usuario de la cuenta titular: {{$reportesproyectodatos->soab_nombres}} {{ $reportesproyectodatos->soab_ap_paterno}} {{ $reportesproyectodatos->soab_ap_materno}}</h2>
                    <h2>Número de trabajos: {{$reportesproyectodatos->totaljobs}}</h2>
                    <h2>Número de horas CPU utilizadas : {{$reportesproyectodatos->totalnodo}}</h2>
                    <h2>Número total de horas aprobadas: {{$reportesproyectodatos->proy_hrs_aprobadas}}  </h2>
                    <h2>Recursos restantes en horas: {{$reportesproyectodatos->proy_hrs_aprobadas - $reportesproyectodatos->totalnodo}}  </h2>
                    <h2>Porcentaje de uso: {{$reportesproyectodatos->porcentajeproyecto}}%  </h2>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $reportesproyectodatos->porcentajeproyecto }}%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>

                    </div>
                </div>

                <h2>Uso de recursos del proyecto por usuario</h2>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Nombre de usuario</th>
                            <th>Número de trabajos</th>
                            <th>Número de horas CPU</th>
                            <th>Porcentaje de uso del mes</th>




                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($reportesproyectos as $reportesproyecto)
                        <tr>

                            <td> {{$reportesproyecto->usua_id_usuario}}</td>
                            <td> {{$reportesproyecto->totaljobs}}</td>
                            <td> {{$reportesproyecto->totalnodo}}</td>
                            @if ($reportesproyecto->porcentajeproyecto < 50)
                            <td>  <span class="label label-success">{{$reportesproyecto->porcentajeproyecto }}%</span></td>
                            @elseif ($reportesproyecto->porcentajeproyecto >= 50 && $reportesproyecto->porcentajeproyecto < 80)
                            <td>  <span class="label label-warning">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                            @else ($reportesproyecto->porcentajeproyecto > 80)
                            <td>  <span class="label label-danger">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                            @endif



                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

                <a href="{{ URL::to('gestionarproyectos/consultarproyectosvista') }}"
                   class="btn btn-success btn-md">Regresar</a>
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
@endsection




