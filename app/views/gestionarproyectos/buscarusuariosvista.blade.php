@extends('dashboardlayout')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Proyecto
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
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'buscarusuarios', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Buscar Usuarios</h2>


                <div class="form-group">
                    {{ Form::label('nom', 'Nombre del usuario')}}
                    {{ Form::text('q', null , ['class' => 'form-control'])}}
                </div>


                <div class="form-group">
                    {{ Form::label('edo', 'Tipo de usuario')}}
                    <select name="tipousuario" id="tipousuario" class="form-control" >
                        <option value="2" > Cuenta titular</option>
                        <option value="3" > Cuenta colaboradora</option>
                        <option value="4" > Todos los usuarios</option>
                    </select>
                </div>








                <div class="form-group">
                    <p>
                        <input type="submit" value="Buscar" class="btn btn-success btn-lg">
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