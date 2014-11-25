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
                        <i class="fa fa-table"></i> Cambiar Estado De Un Proyecto
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'cambiarestadoproyecto', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Cambiar Estado De Un Proyecto</h2>


                <div class="form-group">
                    {{ Form::label('nom', 'Nombre del proyecto')}}
                    {{ Form::text('q', null , ['class' => 'form-control'])}}
                </div>


                <div class="form-group">
                    {{ Form::label('edo', 'Estado del proyecto')}}
                    <select name="estado" id="estado" class="form-control" >
                        <option value="1" > Activo </option>
                        <option value="2" > Inactivo</option>
                        <option value="3" > Terminado</option>
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