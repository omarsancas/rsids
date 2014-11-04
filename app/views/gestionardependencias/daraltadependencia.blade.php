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
                        <i class="fa fa-table"></i> Dar de alta una dependencia
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'daraltadependencia', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Dar de alta una dependencia</h2>


                <div class="form-group">
                    {{ Form::label('nombre completo', 'Nombre completo de la dependencia')}}
                    {{ Form::text('nombredependencia', Input::old('nombredependencia') , ['class' => 'form-control'])}}
                    @if ($errors->has('nombredependencia')) <li class="list-group-item list-group-item-danger">{{ $errors->first('nombredependencia') }}</li> @endif
                </div>


                <div class="form-group">
                    {{ Form::label('acrp', 'Acrónimo')}}
                    {{ Form::text('acronimo', Input::old('acronimo') , ['class' => 'form-control'])}}
                    @if ($errors->has('acronimo')) <li class="list-group-item list-group-item-danger">{{ $errors->first('acronimo') }}</li> @endif
                </div>

                <div class="form-group">
                    {{ Form::label('tipo', 'Tipo de dependencia')}}
                    <select name="tipodependencia" id="tipodependencia" class="form-control" >
                        <option value="1" > Interna </option>
                        <option value="2" > Externa</option>

                    </select>
                </div>






                <div class="form-group">
                    <p>
                        <input type="submit" value="Registrar" class="btn btn-success btn-lg">
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