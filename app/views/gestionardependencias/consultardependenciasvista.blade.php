@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Dependencias
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar Dependencias
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('update' ), 'id' => 'idForm')) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Consultar Dependencias</h2>



                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de la dependencia</th>
                            <th>Nombre de la dependencia</th>
                            <th>Acronimo de la dependencia</th>
                            <th>Tipo de dependencia</th>



                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($dependencias as $dependencia)
                        <tr>


                            <td> {{$dependencia->DEPE_ID_DEPENDENCIA}}</td>
                            <td> {{$dependencia->DEPE_NOMBRE}}</td>
                            <td> {{$dependencia->TIDE_TIPO}}</td>
                            <td> {{$dependencia->DEPE_ACRONIMO}}</td>



                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ Form::close() }}
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection