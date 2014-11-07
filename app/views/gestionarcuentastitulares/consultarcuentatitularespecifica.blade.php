
@extends('dashboardlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar cuenta titular
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Consultar cuentas titulares
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-10">

                <div class="jumbotron">
                    <h4>Nombre del proyecto: {{$proyecto->proy_nombre}}</h4>
                    <h4>Nombre completo de la cuenta: {{$proyecto->usua_nom_completo}}</h4>
                    @foreach($usuariosproyecto as $usuarioproyecto)
                    <h4>Nombre completo de la cuenta colaboradora: {{$usuarioproyecto->usua_nom_completo}}</h4>
                    @endforeach
                    <h4>Recursos asignados al proyecto: {{$proyecto->proy_hrs_aprobadas}}</h4>
                    <h4>Número de trabajos: {{$proyecto->totaljobs}}</h4>
                    <h4>Número total de horas : {{$proyecto->totalnodo}}</h4>
                    <h4>Porcentaje de uso: {{$proyecto->porcentajeproyecto}}%  </h4>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $proyecto->porcentajeproyecto }}%">
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




