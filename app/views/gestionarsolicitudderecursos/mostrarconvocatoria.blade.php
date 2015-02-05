@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Asignar Convocatoria
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Asignar Convocatoria
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'actualizarconvocatoria', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Asignar Convocatoria</h2>

                <input type="hidden" name="id" value="1">
                <div class="form-group">
                    {{ Form::label('nombre completo', 'Año de la convocatoria')}}
                    {{ Form::text('anioconvocatoria', $convocatoria->CONVO_ANIO_CONVO , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('nombre completo', 'Número de proyectos aprobados')}}
                    {{ Form::text('numproyaprobados', $convocatoria->CONVO_PROY_APROBADOS , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('nombre completo', 'Total de recursos convocatoria')}}
                    {{ Form::text('totalrecursosconvo', $convocatoria->CONVO_TOTAL_RECURSOS_SOL , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('nombre completo', 'Total de horas convocatoria')}}
                    {{ Form::text('totalhorasconvo', $convocatoria->CONVO_TOTAL_HRS , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('nombre completo', 'Periodo')}}
                    {{ Form::text('periodoconvo', $convocatoria->CONVO_PERIODO , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('nombre completo', 'Periodo completo')}}
                    {{ Form::text('periodocompconvo', $convocatoria->CONVO_PERIODO_COMP , ['class' => 'form-control'])}}
                </div>


                <div class="form-group">
                    {{ Form::label('nombre completo', 'Ritmo mensual')}}
                    {{ Form::text('ritmomens', $convocatoria->CONVO_RITMO_MENS , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('nombre completo', 'Fecha de devolución del documento')}}
                    {{ Form::text('fechadevolucion', $convocatoria->CONVO_DEVOLUCION , ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    <p>
                        <input type="submit" value="Guardar" class="btn btn-success btn-lg">
                        <a href="{{ URL::to('gestionarsolicitudderecursos/') }}" class="btn btn-lg btn-danger">Cancelar</a>
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