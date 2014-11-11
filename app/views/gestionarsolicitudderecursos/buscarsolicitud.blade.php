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

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar Solicitud
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'buscar', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Consultar Solicitud</h2>


                <div class="form-group">
                    {{ Form::label('tipo', 'Tipo de solicitud')}}
                    <select name="tiposolicitud" id="tiposolicitud" class="form-control" >
                        <option value="1" > Del periodo</option>
                        <option value="2" > Renovación </option>
                        <option value="3" > Ampliación</option>

                    </select>
                </div>


                <div class="form-group">
                    {{ Form::label('edo', 'Estado de la solicitud')}}
                    <select name="estadosolicitud" id="estadosolicitud" class="form-control" >
                        <option value="1" > Pendiente </option>
                        <option value="2" > Aceptada</option>
                        <option value="3" > Rechazada</option>
                    </select>
                </div>

                <div class="form-group">
                    {{ Form::label('mes', 'Mes')}}
                    <select name="mes" id="mes" class="form-control" >
                        <option value="1" > Enero </option>
                        <option value="2" > Febrero</option>
                        <option value="3" > Marzo</option>
                        <option value="4" > Abril </option>
                        <option value="5" > Mayo</option>
                        <option value="6" > Junio</option>
                        <option value="7" > Julio </option>
                        <option value="8" > Agosto</option>
                        <option value="8" > Septiembre </option>
                        <option value="10" > Octubre </option>
                        <option value="11" > Noviembre</option>
                        <option value="12" > Diciembre </option>
                    </select>
                </div>


                <div class="form-group">
                    {{ Form::label('año', 'Año')}}
                    <select name="anio" id="anio" class="form-control" >
                        <option value="2000" > 2000 </option>
                        <option value="2001" > 2001</option>
                        <option value="2002" > 2002</option>
                        <option value="2003" > 2003 </option>
                        <option value="2004" > 2004</option>
                        <option value="2005" > 2005</option>
                        <option value="2006" > 2006 </option>
                        <option value="2007" > 2007</option>
                        <option value="2008" > 2008 </option>
                        <option value="2010" > 2010 </option>
                        <option value="2011" > 2011</option>
                        <option value="2012" > 2012 </option>
                        <option value="2013" > 2013</option>
                        <option value="2014" > 2014 </option>
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