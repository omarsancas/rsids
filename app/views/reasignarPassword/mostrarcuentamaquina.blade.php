@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Reasignar password aplicación
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'cambiarpasswordmaquina', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                <input type="hidden" name="id" value="{{ $maquina->MALO_ID_MAQUINA_LOGIN }}">
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Reasignar password aplicación</h2>


                <div class="form-group">
                    {{ Form::label('nombre de usuario', 'Nombre de usuario')}}
                    {{ Form::text('nombre_usuario', $maquina->MALO_LOGIN , ['class' => 'form-control', 'disabled' => 'disabled'])}}

                </div>

                <div class="form-group">
                    {{ Form::label('password', 'password')}}
                    {{ Form::text('password', '' , ['class' => 'form-control'])}}

                </div>




                <div class="form-group">
                    <p>
                        <input type="submit" value="Cambiar password" class="btn btn-success btn-lg">
                    </p>
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