<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RSIDS Admin</title>

    <!-- Bootstrap Core CSS -->

    <script src="{{ asset ('js/jquery-1.11.0.js')}}" rel="stylesheet"></script>
    <script src="{{ asset ('js/bootstrap.min.js')}}" rel="stylesheet"></script>



    <link href="{{ asset ('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset ('css/plugins/morris.css')}}" rel="stylesheet">





    <!-- Custom CSS -->
    <link href="{{ asset ('css/sb-admin.css')}}" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="{{ asset ('font-awesome-4.1.0/css/font-awesome.min.css')}}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    <![endif]-->

</head>

<body>

<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">RSIDS Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
                <li>
                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">View All</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-power-off"></i> Cerrar sesión</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Gestionar solicitud de recursos <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="{{ URL::to('gestionarsolicitudderecursos/buscarsolicitud') }}">Consultar solicitud</a>

                    </li>
                    <li>
                        <a href="{{ URL::to('gestionarsolicitudderecursos/modificarsolicitud') }}">Modificar Solicitud</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('gestionarsolicitudderecursos/eliminarsolicitud') }}">Eliminar Solicitud</a>

                    </li>

                    <li>
                        <a href="{{ URL::to('gestionarsolicitudderecursos/generarcartas') }}">Generar carta de aceptación de recursos</a>

                    </li>

                    <li>
                        <a href="{{ URL::to('gestionarsolicitudderecursos/notificaraprobacion') }}">Notificar aprobacion de recursos</a>

                    </li>



                </ul>
            </li>




            <li>
                <a href="{{ URL::to('evaluarsolicitudderecursos/evaluarsolicitud') }}">Evaluar solicitud de recursos</a>

            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

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
                        <i class="fa fa-table"></i> Consultar Solicitudes
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
                <h2>Consultar Solicitud de recursos</h2>


                <div class="form-group">
                    {{ Form::label('tipo', 'Tipo de solicitud')}}
                    <select name="tiposolicitud" id="tiposolicitud" class="form-control" >
                        <option value="0" > Del periodo</option>
                        <option value="1" > Renovación </option>
                        <option value="2" > Ampliación</option>

                    </select>
                </div>


                <div class="form-group">
                    {{ Form::label('edo', 'Estado de la solicitud')}}
                    <select name="estadosolicitud" id="estadosolicitud" class="form-control" >
                        <option value="0" > Pendiente </option>
                        <option value="1" > Aceptada</option>
                        <option value="2" > Rechazada</option>
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

</div>
<!-- /#wrapper -->


</body>

</html>
