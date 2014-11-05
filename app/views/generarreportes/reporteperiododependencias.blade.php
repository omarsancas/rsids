@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Generar reportes
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> contabilidad mensual para proyectos
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
                <h3>Contabilidad mensual para proyectos del mes {{$mes }} del año {{$anio}}</h3>

                @if (empty($reportesdependencias))
                <h2>No se encontró ningun proyecto con los parametros elegidos</h2>
                @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de dependencia</th>
                            <th>Nombre de la dependencia</th>
                            <th>Acrónimo de la dependencia</th>
                            <th>Número de trabajos totales de la dependencia</th>
                            <th>Número de horas nodo totales de la dependencia</th>




                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($reportesdependencias as $reportesdependencia)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$reportesdependencia->depe_id_dependencia}}</td>
                            <td> {{$reportesdependencia->depe_nombre}}</td>
                            <td> {{$reportesdependencia->depe_acronimo}}</td>
                            <td> {{$reportesdependencia->totaljobs}}</td>
                            <td> {{$reportesdependencia->totalnodo}}</td>



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