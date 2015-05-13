@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Reasignar Password
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Buscar cuenta
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('reportemensualespecifico' ), 'id' => 'idForm')) }}

                <h2>Buscar Usuarios</h2>


                @if ($resultados)
                <h2>No se encontró ningun usuario con los parametros elegidos</h2>
                @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Login usuario</th>
                            <th>Nombre del usuario</th>
                            <th>Nombre del proyecto</th>
                            <th>Reasignar password vpn</th>
                            <th>Reasignar password maquina</th>
                            <th>Reasingar password aplicación</th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach (resultados as $usuario)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$usuario->USUA_ID_USUARIO}}</td>
                            <td> {{$usuario->USUA_NOM_COMPLETO}}</td>
                            <td> {{$usuario->PROY_NOMBRE}}</td>
                            <td>
                                <a href="{{ action('GestionarCuentasTitularesController@consultarCuentaTitualEspecifica', $usuario->PROY_ID_PROYECTO ) }}"
                                   class="btn btn-info btn-md">Consultar</a>
                            </td>
                            <td></td>
                            <td></td>


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