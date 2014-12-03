@extends('cuentacolaboradoralayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Generar Solicitud Para Soporte Técnico
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Generar Solicitud Para Soporte Técnico
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'enviarsolicitud', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Generar Solicitud Para Soporte Técnico</h2>


                <div class="form-group">
                    {{ Form::label('nombre completo', 'Nombre completo(*)')}}
                    {{ Form::text('nombrecompleto', Input::old('nombrecompleto') , ['class' => 'form-control'])}}
                    @if ($errors->has('nombrecompleto')) <li class="list-group-item list-group-item-danger">{{ $errors->first('nombredependencia') }}</li> @endif
                </div>


                <div class="form-group">
                    {{ Form::label('acrp', 'Correo electronico(*)')}}
                    {{ Form::text('correoelectronico', Input::old('correoelectronico') , ['class' => 'form-control'])}}
                    @if ($errors->has('correoelectronico')) <li class="list-group-item list-group-item-danger">{{ $errors->first('acronimo') }}</li> @endif
                </div>


                    <div class="form-group">
                    {{ Form::label('asunto','Asunto de la solicitud')}}
                    {{ Form::text('asunto',null,['class'=>'form-control'])}}
                    </div>

                <div class="form-group">
                {{ Form::label('contenido','Contenido de la Solicitud')}}
                {{ Form::textarea('contenido',null,['class'=>'form-control'])}}
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