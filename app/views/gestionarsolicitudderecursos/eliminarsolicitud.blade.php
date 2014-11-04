@extends('dashboardlayout')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Solicitud de recursos
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Eliminar Solicitud de recursoss
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                {{ Form::open(array('route' => array('delete' ), 'id' => 'idForm')) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Eliminar Solicitud de recursos</h2>

                <button id="btnDelete" class="btn btn-danger btn-lg">¡Eliminar!</button>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
                            <th>Número de la solicitud</th>
                            <th>Nombre Completo del proyecto</th>
                            <th>Nombre del titular del proyecto</th>
                            <th>Tipo de solicitud</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($solicitudes as $solicitud)
                        <tr>
                            <td class="col-lg-1" style="text-align: center;"> <input type="checkbox" name="check_box[]" data-id="check_box[]" value="{{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}" /></td>
                            <td class="visible-xs visible-lg"> {{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}</td>
                            <td> {{$solicitud->SOAB_NOMBRE_PROYECTO}}</td>
                            <td> {{$solicitud->SOAB_NOMBRES}}</td>
                            <td> {{$solicitud->TISO_NOMBRE}}</td>


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