
@extends('dashboardlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar proyectos
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Consultar un proyecto
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-10">

                <div class="jumbotron">
                    <h2>Nombre del proyecto: {{$usuarioproyecto->proy_nombre}}</h2>
                    <h2>Nombre de la cuenta: {{$usuarioproyecto->usua_nom_completo}}</h2>
                    <h2>Número de trabajos: {{$usuarioproyecto->totaljobs}}</h2>
                    <h2>Número total de horas : {{$usuarioproyecto->totalnodo}}</h2>
                    <h2>Porcentaje de uso: {{$usuarioproyecto->porcentajeproyecto}}%  </h2>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $usuarioproyecto->porcentajeproyecto }}%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>

                    </div>
                </div>

               
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
@endsection




