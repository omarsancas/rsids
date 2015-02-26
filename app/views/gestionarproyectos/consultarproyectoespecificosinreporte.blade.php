
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
                    <h2>Número proyecto: {{$proyectosinreporte->PROY_ID_PROYECTO}}</h2>
                    <h2>Nombre del proyecto: {{$proyectosinreporte->PROY_NOMBRE}}</h2>
                    <h2>Tipo de proyecto: {{$proyectosinreporte->TIPR_NOMBRE_TIPO_PROYECTO}}</h2>
                    <h2>Estado del proyecto: {{$proyectosinreporte->ESPR_TIPO_ESTADO}}</h2>
                    <h2>Fecha de inicio de recursos: {{$proyectosinreporte->PROY_FEC_INI_RECU}}</h2>
                    <h2>Fecha de termino de recursos: {{$proyectosinreporte->PROY_FEC_TERM_RECU}}</h2>
                    <h2>Fecha de ultimo cambio de estado: {{$proyectosinreporte->PROY_FEC_CAMBIO_EST}}</h2>
                    <h2>Fecha de termino de reanudación de estado: {{$proyectosinreporte->PROY_FEC_REANUD_EST}}</h2>
                    <h2>Fecha de registro del proyecto: {{$proyectosinreporte->PROY_FECHA_REGISTRO}}</h2>
                    <h2>Nombre de usuario de la cuenta titular: {{$proyectosinreporte->SOAB_NOMBRES}} {{ $proyectosinreporte->SOAB_AP_PATERNO}} {{ $proyectosinreporte->SOAB_AP_MATERNO}}</h2>
                    <h2>Número de trabajos: N/A</h2>
                    <h2>Número de horas CPU utilizadas : N/A</h2>
                    <h2>Número total de horas aprobadas: {{$proyectosinreporte->PROY_HRS_APROBADAS}}  </h2>


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




