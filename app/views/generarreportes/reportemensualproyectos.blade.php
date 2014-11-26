@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Generar Reportes
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Contabilidad Mensual Para Proyectos
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('reportemensualespecifico' ), 'id' => 'idForm')) }}
                <input type="hidden" name="mes" value="{{ $mes}}">
                <input type="hidden" name="anio" value="{{ $anio}}">
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Contabilidad Mensual Para Proyectos</h2>


                @if (empty($reportesproyectos))
                <h2>No se encontraron coincidencias con los parámetros elegidos</h2>
                <a href="{{URL::to('generarreportes/contabilidadmensualproyectos')}}" class="btn btn-info btn-lg"> Regresar</a>

                @else
                <a href="{{URL::to('generarreportes/contabilidadmensualproyectos')}}" class="btn btn-info btn-lg"> Regresar</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de proyecto</th>
                            <th>Nombre del proyecto</th>
                            <th>Número de trabajos</th>
                            <th>Número total de horas CPU utilizadas</th>
                            <th>Recursos restantes</th>
                            <th>Porcentaje de uso</th>
                            <th>Acción</th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($reportesproyectos as $reportesproyecto)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$reportesproyecto->proy_id_proyecto}}</td>
                            <td> {{$reportesproyecto->proy_nombre}}</td>
                            <td> {{$reportesproyecto->totaljobs}}</td>
                            <td> {{$reportesproyecto->totalnodo}}</td>
                            <td>  {{ $reportesproyecto->proy_hrs_aprobadas - $reportesproyecto->totalnodo}}</td>
                            @if ($reportesproyecto->porcentajeproyecto < 50)
                            <td>  <span class="label label-success">{{$reportesproyecto->porcentajeproyecto }}%</span></td>
                            @elseif ($reportesproyecto->porcentajeproyecto >= 50 && $reportesproyecto->porcentajeproyecto < 80)
                            <td>  <span class="label label-warning">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                            @else ($reportesproyecto->porcentajeproyecto >= 80)
                            <td>  <span class="label label-danger">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                            @endif
                            <td>
                                <a href="{{ action('GenerarReportesController@mostrarReporteProyectoEspecifico', array($reportesproyecto->proy_id_proyecto, $mes, $anio, false) ) }}" class="btn btn-info btn-md">Ver desglose del proyecto</a>
                            </td>


                        </tr>
                        @endforeach
                        <td> </td>
                        <td> </td>
                        <td> Total numero de trabajos: {{ $totalproyectos->totaljobs}}</td>

                        <td> Total horas nodo: {{ $totalproyectos->totalnodo}}</td>

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