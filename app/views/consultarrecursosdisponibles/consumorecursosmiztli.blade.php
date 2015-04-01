@extends('dashboardlayout')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Consultar Recursos Disponibles
                </h1>
                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i> Consultar Recursos Disponibles
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Revisar la ruta de actualizacion-->
                {{ Form::open(array('route' => array('mostrarconsumorecursosmiztliporperiodo' ), 'id' => 'idForm')) }}

                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2>Consumo De Recursos Miztli </h2>

                <div class="row">
                    <div class="form-group row col-md-2">
                        {{ Form::label('mes', 'Mes inicial')}}
                        <select name="mes" id="mes" class="form-control">
                            <option value="1"> Enero</option>
                            <option value="2"> Febrero</option>
                            <option value="3"> Marzo</option>
                            <option value="4"> Abril</option>
                            <option value="5"> Mayo</option>
                            <option value="6"> Junio</option>
                            <option value="7"> Julio</option>
                            <option value="8"> Agosto</option>
                            <option value="9"> Septiembre</option>
                            <option value="10"> Octubre</option>
                            <option value="11"> Noviembre</option>
                            <option value="12"> Diciembre</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        {{ Form::label('año', 'Año inicial')}}
                        <select name="anio" id="anio" class="form-control">
                            <option value="2000"> 2000</option>
                            <option value="2001"> 2001</option>
                            <option value="2002"> 2002</option>
                            <option value="2003"> 2003</option>
                            <option value="2004"> 2004</option>
                            <option value="2005"> 2005</option>
                            <option value="2006"> 2006</option>
                            <option value="2007"> 2007</option>
                            <option value="2008"> 2008</option>
                            <option value="2010"> 2010</option>
                            <option value="2011"> 2011</option>
                            <option value="2012"> 2012</option>
                            <option value="2013"> 2013</option>
                            <option value="2014"> 2014</option>
                            <option value="2015"> 2015</option>
                            <option value="2016"> 2016</option>
                            <option value="2017"> 2017</option>
                        </select>
                    </div>



                    <div class="form-group row col-md-2">
                        {{ Form::label('mes', 'Mes Final')}}
                        <select name="mes2" id="mes2" class="form-control">
                            <option value="1"> Enero</option>
                            <option value="2"> Febrero</option>
                            <option value="3"> Marzo</option>
                            <option value="4"> Abril</option>
                            <option value="5"> Mayo</option>
                            <option value="6"> Junio</option>
                            <option value="7"> Julio</option>
                            <option value="8"> Agosto</option>
                            <option value="8"> Septiembre</option>
                            <option value="10"> Octubre</option>
                            <option value="11"> Noviembre</option>
                            <option value="12"> Diciembre</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        {{ Form::label('año', 'Año Final')}}
                        <select name="anio2" id="anio2" class="form-control">
                            <option value="2000"> 2000</option>
                            <option value="2001"> 2001</option>
                            <option value="2002"> 2002</option>
                            <option value="2003"> 2003</option>
                            <option value="2004"> 2004</option>
                            <option value="2005"> 2005</option>
                            <option value="2006"> 2006</option>
                            <option value="2007"> 2007</option>
                            <option value="2008"> 2008</option>
                            <option value="2010"> 2010</option>
                            <option value="2011"> 2011</option>
                            <option value="2012"> 2012</option>
                            <option value="2013"> 2013</option>
                            <option value="2014"> 2014</option>
                            <option value="2015"> 2015</option>
                            <option value="2016"> 2016</option>
                            <option value="2017"> 2017</option>
                            <option value="2018"> 2018</option>
                            <option value="2019"> 2019</option>
                            <option value="2017"> 2020</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">

                    <input type="submit" value="Buscar" class="btn btn-success btn-lg">
                </div>

                @if (empty($reportesproyectos))


                <h2>No se encontraron coincidencias con los parámetros elegidos</h2>

                @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>Número de proyecto</th>
                            <th>Nombre del proyecto</th>
                            <th>Nombre completo del usuario cuenta titular</th>
                            <th>Dependencia</th>
                            <th>Número de trabajos</th>
                            <th>Número total de horas CPU utilizadas</th>
                            <th>Recursos aprobados</th>
                            <th>Recursos restantes</th>
                            <th>Porcentaje de uso</th>
                            <th>Fecha de término</th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($reportesproyectos as $reportesproyecto)
                        <tr>

                            <td class="visible-xs visible-lg"> {{$reportesproyecto->proy_id_proyecto}}</td>
                            <td> {{$reportesproyecto->proy_nombre}}</td>
                            <td> {{$reportesproyecto->soab_nombres}} {{$reportesproyecto->soab_ap_paterno}}
                                {{$reportesproyecto->soab_ap_materno}}
                            </td>
                            <td>{{$reportesproyecto->depe_nombre}}</td>
                            <td> {{$reportesproyecto->totaljobs}}</td>
                            <td> {{$reportesproyecto->totalnodo}}</td>
                            <td>{{$reportesproyecto->proy_hrs_aprobadas}}</td>
                            <td> {{ $reportesproyecto->proy_hrs_aprobadas - $reportesproyecto->totalnodo}}</td>
                            @if ($reportesproyecto->porcentajeproyecto < 50)
                            <td>  <span class="label label-success">{{$reportesproyecto->porcentajeproyecto }}%</span></td>
                            @elseif ($reportesproyecto->porcentajeproyecto >= 50 && $reportesproyecto->porcentajeproyecto < 80)
                            <td>  <span class="label label-warning">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                            @else ($reportesproyecto->porcentajeproyecto >= 80)
                            <td>  <span class="label label-danger">{{ $reportesproyecto->porcentajeproyecto  }}%</span></td>
                            @endif
                            <td>{{ $reportesproyecto->proy_fec_term_recu}}</td>


                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                @endif
                {{ Form::close() }}
            </div>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection