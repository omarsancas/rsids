
@extends('dashboardlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Cuenta Titular
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar Cuentas Titulares
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-10">

                <div class="jumbotron">
                    <h4>Nombre del proyecto: {{$proyecto->proy_nombre}}</h4>
                    <h4>Nombre del propietario de la cuenta titular: {{$proyecto->usua_nom_completo}}</h4>
                    <h4>Dependencia: {{ $proyecto->depe_nombre}} </h4>
                    <h4>Correo electronico: {{$proyecto->meco_correo }}</h4>
                    <h4>Número telefónico: {{$proyecto->meco_telefono1 }}</h4>
                    <h4>Grado académico: {{$proyecto->grad_nombre }}</h4>
                    <h4>Campo de trabajo: {{$proyecto->catr_nombre_campo }}</h4>
                    <h4>Linea de especialización: {{$proyecto->soab_lin_especializacion }} </h4>
                    @foreach($usuariosproyecto as $usuarioproyecto)
                    <h4>Nombre completo de la cuenta colaboradora: {{$usuarioproyecto->usua_nom_completo}}</h4>
                    @endforeach
                    <h4>Recursos asignados al proyecto: {{$proyecto->proy_hrs_aprobadas}}</h4>
                    <h4>Número de trabajos: {{$proyecto->totaljobs}}</h4>
                    <h4>Número total de horas consumidas: {{$proyecto->totalnodo}}</h4>
                    <h4>Porcentaje de uso: {{$proyecto->porcentajeproyecto}}%  </h4>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $proyecto->porcentajeproyecto }}%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>

                    </div>
                </div>

                <a href="{{ URL::to('gestionarproyectos/consultarcuentatitularvista') }}" class="btn btn-danger">Regresar</a>


            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
@endsection




