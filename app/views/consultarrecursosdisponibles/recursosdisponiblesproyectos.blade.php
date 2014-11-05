@extends('dashboardlayout')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Consultar recursos disponibles
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Consultar recursos disponibles
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'mostrarrecursosdisponibles', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Contabilidad mensual para proyectos</h2>

                <h3>Elige el mes y el año que deseas consultar</h3>



                <div class="form-group">
                    {{ Form::label('mes', 'Recursos disponibles para proyectos')}}
                    <select name="porcentaje" id="porcentaje" class="form-control" >
                        <option value="1" > Menor a 50% </option>
                        <option value="2" > Entre 50% y 85%</option>
                        <option value="3" > Mayores a 85% </option>

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