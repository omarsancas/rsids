@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Dependencia
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Dar de Bajar una Dependencia
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                {{ Form::open(array('route' => array('eliminardependencias'), 'id' => 'idForm')) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Dar de Bajar una Dependencia</h2>

                <button id="btnDelete" class="btn btn-danger btn-lg">¡Eliminar!</button>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="col-lg-1" style="text-align: center;">Eliminar </th>
                            <th>Nombre de la dependencia</th>
                            <th>Acronimo</th>
                            <th>Tipo de dependencia</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($dependencias as $dependencia)
                        <tr>
                            <td class="col-lg-1" style="text-align: center;"> <input type="checkbox" name="check_box[]" data-id="check_box[]" value="{{$dependencia->DEPE_ID_DEPENDENCIA}}" /></td>
                            <td> {{$dependencia->DEPE_NOMBRE}}</td>
                            <td> {{$dependencia->DEPE_ACRONIMO}}</td>
                            <td> {{$dependencia->TIDE_TIPO}}</td>


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