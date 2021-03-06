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

                    <li class="active">
                            <i class="fa fa-table"></i> Cambiar Estado De Un Proyecto
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('reportemensualespecifico' ), 'id' => 'idForm')) }}

                <h2>Cambiar Estado De Un Proyecto</h2>


                @if (empty($proyectos))
                <h2>No se encontró ningun proyecto con los parametros elegidos</h2>
                @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de proyecto</th>
                            <th>Nombre del proyecto</th>
                            <th>Nombre del titular del proyecto</th>
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
                                <a href="{{ action('GestionarProyectosController@cambiarEstadoProyectoEspecifico', $proyecto->PROY_ID_PROYECTO ) }}"
                                   class="btn btn-info btn-md">Cambiar estado</a>
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