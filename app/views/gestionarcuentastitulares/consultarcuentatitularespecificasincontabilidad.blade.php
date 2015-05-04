
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
                    <h4>Nombre del proyecto: {{$proyectosincontabilidad->PROY_NOMBRE}}</h4>
                    <h4>Nombre del propietario de la cuenta titular: {{$proyectosincontabilidad->USUA_NOM_COMPLETO}}</h4>
                    <h4>Dependencia: {{ $proyectosincontabilidad->DEPE_NOMBRE}} </h4>
                    <h4>Correo electronico: {{$proyectosincontabilidad->MECO_CORREO }}</h4>
                    <h4>Número telefónico: {{$proyectosincontabilidad->MECO_TELEFONO1 }}</h4>
                    <h4>Grado académico: {{$proyectosincontabilidad->GRAD_NOMBRE }}</h4>
                    <h4>Campo de trabajo: {{$proyectosincontabilidad->CATR_NOMBRE_CAMPO }}</h4>
                    <h4>Linea de especialización: {{$proyectosincontabilidad->SOAB_LIN_ESPECIALIZACION }} </h4>
                    @foreach($usuariosproyecto as $usuarioproyecto)
                    <h4>Nombre completo de la cuenta colaboradora: {{$usuarioproyecto->usua_nom_completo}}</h4>
                    @endforeach

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




