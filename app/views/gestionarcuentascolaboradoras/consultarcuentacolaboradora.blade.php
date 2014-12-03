@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Cuentas Colaboradoras
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar Cuenta Colaboradora
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->


                <h2>Consultar Cuenta Colaboradora</h2>


                @if (empty($proyectos))
                <h2>No se encontraron coincidencias con el parámetros elegido</h2>
                @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de proyecto</th>
                            <th>Nombre del proyecto</th>
                            <th>Nombre del completo del Usuario cuenta colaboradora</th>
                            <th>Accion</th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($proyectos as $proyecto)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$proyecto->PROY_ID_PROYECTO}}</td>
                            <td> {{$proyecto->PROY_NOMBRE}}</td>
                            <td> {{$proyecto->USUA_NOM_COMPLETO}}</td>
                            <td>
                                <a href="{{ action('GestionarCuentasColaboradorasController@consultarCuentaColaboradora', $proyecto->USUA_ID_USUARIO ) }}"
                                   class="btn btn-info btn-md">Consultar cuenta colaboradora</a>
                            </td>


                        </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                @endif



            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    @endsection