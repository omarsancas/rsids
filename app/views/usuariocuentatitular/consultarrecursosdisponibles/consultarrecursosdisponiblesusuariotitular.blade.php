
@extends('cuentatitularlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Consultar recursos disponibles
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar recursos disponibles
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-7">
                @if (empty($reportesproyectodatos))
                <h2>No hay datos disponibles para mostrar los recursos disponibles del proyecto</h2>

                @else
                <div class="jumbotron">
                    <h3>Número del proyecto: {{$reportesproyectodatos->proy_id_proyecto}}</h3>
                    <h3>Nombre del proyecto: {{$reportesproyectodatos->proy_nombre}}</h3>
                    <h3>Dependencia: {{$reportesproyectodatos->depe_nombre}}</h3>
                    <h3>Nombre de la cuenta titular: {{$reportesproyectodatos->soab_nombres}} {{ $reportesproyectodatos->soab_ap_paterno}} {{ $reportesproyectodatos->soab_ap_materno}}</h3>
                    <h3>Recursos aprobados: {{$reportesproyectodatos->proy_hrs_aprobadas}}  </h3>
                    <h3>Recursos restantes: {{$reportesproyectodatos->proy_hrs_aprobadas - $reportesproyectodatos->totalnodo}}  </h3>

                    <h3>Porcentaje de uso: {{$reportesproyectodatos->porcentajeproyecto}}%  </h3>
                    @if ($reportesproyectodatos->porcentajeproyecto < 50)
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $reportesproyectodatos->porcentajeproyecto }}%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>

                    </div>
                    @elseif ($reportesproyectodatos->porcentajeproyecto >= 50 && $reportesproyectodatos->porcentajeproyecto < 80)
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $reportesproyectodatos->porcentajeproyecto }}%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>

                    </div>
                    @else ($reportesproyectodatos->porcentajeproyecto > 80)
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $reportesproyectodatos->porcentajeproyecto }}%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>

                    </div>
                    @endif

                    @endif

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
@endsection




