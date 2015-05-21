@extends('dashboardlayout')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Cuentas Login Maquina
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-table"></i> Gestionar Cuentas Login Maquina
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                {{ Form::open(array('route' => array('obfuscarcuentas' ), 'id' => 'idForm')) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Gestionar Cuentas Login Maquina</h2>

                <button id="btnDelete" class="btn btn-danger btn-lg">Obfuscar</button>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
                            <th>Login</th>
                            <th>Maquina login nombre</th>
                            <th>Maquina grupo principal</th>
                            <th>Maquina principal</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cuentas as $cuenta)
                        <tr>
                            <td class="col-lg-1" style="text-align: center;"> <input type="checkbox" name="check_box[]" data-id="check_box[]" value="{{$cuenta->MALO_ID_MAQUINA_LOGIN}}" /></td>
                            <td class="visible-xs visible-lg"> {{$cuenta->MALO_LOGIN}}</td>
                            <td> {{$cuenta->MALO_NOMBRE}}</td>
                            <td> {{$cuenta->MALO_GRUPO_PRINCIPAL}}</td>
                            <td> {{$cuenta->MALO_MAQUINA}}</td>


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