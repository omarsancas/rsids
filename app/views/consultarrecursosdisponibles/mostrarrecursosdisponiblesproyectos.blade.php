@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Consultar Recursos Disponibles
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar Recursos Disponibles
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                <!--{{ Form::open(array('route' => array('reportemensualespecifico' ), 'id' => 'idForm')) }}-->

                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Consultar Recursos Disponibles</h2>


                @if (empty($recursosdisponiblesproyectos))
                <h2>No se encontraron coincidencias con los parámetros elegidos</h2>
                <a href="{{URL::to('consultarrecursosdisponibles/recursosdisponiblesproyectos')}}" class="btn btn-lg btn-info">Regresar</a>
                @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de proyecto</th>
                            <th>Nombre del proyecto</th>
                            <th>Nombre completo del usuario cuenta titular</th>
                            <th>Dependencia</th>
                            <th>Número de trabajos</th>
                            <th>Número total de horas CPU utilizadas</th>
                            <th>Recursos aprobados</th>
                            <th>Recursos restantes</th>
                            <th>Porcentaje de uso</th>
                            <th>Fecha de termino</th>



                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($recursosdisponiblesproyectos as $recursosdisponiblesproyecto)
                        @if( $recursosdisponiblesproyecto->porcentajeproyecto < 50)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$recursosdisponiblesproyecto->proy_id_proyecto}}</td>
                            <td> {{$recursosdisponiblesproyecto->proy_nombre}}</td>
                            <td> {{$recursosdisponiblesproyecto->soab_nombres}} {{$recursosdisponiblesproyecto->soab_ap_paterno}} {{$recursosdisponiblesproyecto->soab_ap_materno}} </td>
                            <td>{{$recursosdisponiblesproyecto->depe_nombre}}</td>
                            <td> {{$recursosdisponiblesproyecto->totaljobs}}</td>
                            <td> {{$recursosdisponiblesproyecto->totalnodo}}</td>
                            <td>{{$recursosdisponiblesproyecto->proy_hrs_aprobadas}}</td>
                            <td>  {{ $recursosdisponiblesproyecto->proy_hrs_aprobadas - $recursosdisponiblesproyecto->totalnodo}}</td>
                            <td>  <span class="label label-success">{{$recursosdisponiblesproyecto->porcentajeproyecto }}%</span></td>
                            <td>{{ $recursosdisponiblesproyecto->proy_fec_term_recu}}</td>



                        </tr>

                        @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
                @endif
                <!--{{ Form::close() }}-->
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection