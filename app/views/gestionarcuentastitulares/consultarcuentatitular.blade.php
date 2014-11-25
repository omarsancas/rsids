@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Cuentas Titulares
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Buscar Usuarios
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


                @if (empty($usuarios))
                <h2>No se encontró ningun usuario con los parametros elegidos</h2>
                @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Usuario</th>
                            <th>Tipo de usuario</th>
                            <th>Nombre del proyecto</th>
                            <th>Accion</th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($usuarios as $usuario)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$usuario->USUA_ID_USUARIO}}</td>
                            <td> {{$usuario->TIUS_TIPO_NOMBRE}}</td>
                            <td> {{$usuario->PROY_NOMBRE}}</td>
                            <td>
                                <a href="{{ action('GestionarCuentasTitularesController@consultarCuentaTitualEspecifica', $usuario->PROY_ID_PROYECTO ) }}"
                                   class="btn btn-info btn-md">Consultar</a>
                            </td>


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