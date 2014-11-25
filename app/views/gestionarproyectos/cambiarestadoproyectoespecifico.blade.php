
@extends('dashboardlayout')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestionar proyectos
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Cambiar Estado De Un Proyecto
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        {{ Form::open (['route' => 'guardarcambioestadoproyectoespecifico', 'method' => 'UPDATE','class' => 'form-horizontal', 'role' =>'form', 'files' =>true]) }}
        <input type="hidden" name="id" value="{{ $proyecto->PROY_ID_PROYECTO }}">
        <div class="row">
            <div class="col-lg-10">

                <div class="jumbotron">

                    <div class="form-group">
                        {{ Form::label('nombre', 'Nombre completo del proyecto')}}
                        {{ Form::text('nombreproyecto', $proyecto->PROY_NOMBRE , ['class' => 'form-control','disabled' => 'disabled'])}}

                    </div>


                    <div class="form-group">
                        {{ Form::label('estadoproyecto', 'Estado del proyecto')}}
                        {{ Form::select('estadoproyecto',$estadoproyecto, $proyecto->PROY_ID_ESTADO_PROYECTO, array('class'=>'form-control','style'=>'' ))}}
                    </div>


                    <div class="form-group">
                        <p>
                            <input type="submit" value="Guardar" class="btn btn-success btn-lg">
                        </p>

                        <a href="{{URL::to('gestionarproyectos/cambiarestadoproyectovista')}}" class="btn btn-lg btn-danger"> Cancelar</a>
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




