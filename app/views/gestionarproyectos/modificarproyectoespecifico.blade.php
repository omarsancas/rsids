
@extends('dashboardlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar Proyectos
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Modificar Proyecto
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        {{ Form::open (['route' => 'modificarguardarproyectoespecifico', 'method' => 'UPDATE','class' => 'form-horizontal', 'role' =>'form', 'files' =>true]) }}
        <input type="hidden" name="id" value="{{ $proyecto->PROY_ID_PROYECTO }}">
        <div class="row">
            <div class="col-lg-10">

                <div class="jumbotron">

                    <div class="form-group">
                        {{ Form::label('nombre', 'Nombre completo del proyecto(*)')}}
                        {{ Form::text('nombreproyecto', $proyecto->PROY_NOMBRE , ['class' => 'form-control'])}}

                    </div>


                    <div class="form-group">
                        {{ Form::label('nombre', 'Fecha de inicio de recursos(*)')}}
                        {{ Form::text('fechaini', $proyecto->PROY_FEC_INI_RECU , ['class' => 'form-control'])}}

                    </div>

                    <div class="form-group">
                        {{ Form::label('nombre', 'Fecha de termino de recursos(*)')}}
                        {{ Form::text('fechaterm', $proyecto->PROY_FEC_TERM_RECU , ['class' => 'form-control'])}}

                    </div>


                    <div class="form-group">
                        {{ Form::label('nombre', 'Fecha de registro de recursos(*)')}}
                        {{ Form::text('fechareg', $proyecto->PROY_FECHA_REGISTRO , ['class' => 'form-control'])}}

                    </div>

                    <div class="form-group">
                        <p>
                            <input type="submit" value="Guardar" class="btn btn-success btn-lg">
                        </p>

                        <a href="{{URL::to('gestionarproyectos/modificarproyectosvista') }}" class="btn btn-lg btn-danger"> Cancelar</a>
                    </div>
                </div>



        </div>
        <!-- /.row -->
            {{ Form::close() }}
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
@endsection




