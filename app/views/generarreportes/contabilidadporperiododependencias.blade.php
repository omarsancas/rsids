@extends('dashboardlayout')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Generar reportes
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Generar reportes
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(['route' => 'genreportesporperiododependencias', 'method' => 'POST','class' => 'form-horizontal', 'role' => 'form']) }}
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Contabilidad por periodo para dependencias</h2>

                <h3>Elige el mes y el año que deseas consultar</h3>



                <div class="form-group">
                    {{ Form::label('mes', 'Mes inicial')}}
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
                    {{ Form::label('año', 'Año inicial')}}
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
                    {{ Form::label('mes', 'Mes final')}}
                    <select name="mes2" id="mes2" class="form-control" >
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
                    {{ Form::label('año', 'Año final')}}
                    <select name="anio2" id="anio2" class="form-control" >
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
                        <input type="submit" value="Generar reporte" class="btn btn-success btn-lg">
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