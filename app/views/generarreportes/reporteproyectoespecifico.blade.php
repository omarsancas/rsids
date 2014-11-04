
        @extends('dashboardlayout')

        @section('content')


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Generar reporte mensual del mes {{$mes }} del {{ $anio}}
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Generar reporte mensual por proyecto
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-10">

                        <div class="jumbotron">
                            <h3>ID del proyecto: {{$reportesproyectodatos->proy_id_proyecto}}</h3>
                            <h3>Nombre del proyecto: {{$reportesproyectodatos->proy_nombre}}</h3>
                            <h3>Dependencia: {{$reportesproyectodatos->depe_nombre}}</h3>
                            <h3>Nombre de la cuenta titular: {{$reportesproyectodatos->soab_nombres}} {{ $reportesproyectodatos->soab_ap_paterno}} {{ $reportesproyectodatos->soab_ap_materno}}</h3>
                            <h3>Horas aprobadas: {{$reportesproyectodatos->proy_hrs_aprobadas}}  </h3>
                            <h3>Saldo de horas: {{$reportesproyectodatos->proy_hrs_aprobadas - $reportesproyectodatos->totalnodo}}  </h3>

                            <h3>Porcentaje de uso: {{$reportesproyectodatos->porcentajeproyecto}}%  </h3>
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
                                    <th>Número de horas nodo</th>
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
                                    @elseif ($reportesproyecto->porcentajeproyecto >= 50)
                                    <td>  <span class="label label-warning">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                                    @else ($reportesproyecto->porcentajeproyecto > 80)
                                    <td>  <span class="label label-danger">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                                    @endif



                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        @endsection




