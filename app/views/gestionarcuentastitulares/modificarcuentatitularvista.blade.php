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
                        <i class="fa fa-table"></i> Modificar Cuenta Titular
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'modificarcuentatitular', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Modificar cuenta titular</h2>


                <div class="form-group">
                    {{ Form::label('nombre completo', 'Nombre del Usuario cuenta titular')}}
                    {{ Form::text('nombreusuario', '' , ['class' => 'form-control'])}}

                </div>



                <div class="form-group">
                    <p>
                        <input type="submit" value="Buscar" class="btn btn-success btn-lg">
                    </p>
                </div>

                <div class="form-group"

                <a href="{{ URL::to('gestionarproyectos/modificarcuentatitularvista') }}" class="btn btn-danger">Cancelar</a>
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