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


    <link href="{{ asset ('css/bootstrap.css')}}" rel="stylesheet">
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

    <a class="navbar-brand" href="#">RSIDS Admin</a>
    <a class="navbar-brand-center" href="#">
        <img src="{{ asset ('img/logounam.png')}}" alt="">
    </a>
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
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->USUA_ID_USUARIO}} <b
                class="caret"></b></a>
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
                <a href="{{ URL::to('logout') }}"><i class="fa fa-fw fa-power-off"></i> Cerrar sesión</a>
            </li>
        </ul>
    </li>
</ul>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">



        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>
                Gestionar solicitud de recursos <i class="fa fa-fw fa-caret-down"></i></a>
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
                    <a href="{{ URL::to('gestionarsolicitudderecursos/generarcartas') }}">Generar carta de aceptación de
                        recursos</a>

                </li>

                <li>
                    <a href="{{ URL::to('gestionarsolicitudderecursos/notificaraprobacion') }}">Notificar Aprobacion de
                        Recursos</a>

                </li>

                <li>
                    <a href="{{ URL::to('gestionarsolicitudderecursos/notificarrechazo') }}">Notificar Denegación  de
                        Recursos</a>

                </li>


            </ul>
        </li>


        <li>
            <a href="{{ URL::to('evaluarsolicitudderecursos/evaluarsolicitud') }}">Evaluar solicitud de recursos</a>

        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo4"><i class="fa fa-fw fa-arrows-v"></i>
                Gestionar proyectos <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo4" class="collapse">
                <li>
                    <a href="{{ URL::to('gestionarproyectos/consultarproyectosvista') }}">Consultar un proyecto</a>
                </li>
                <li>
                    <a href="{{ URL::to('gestionarproyectos/modificarproyectosvista') }}">Modificar un proyecto</a>
                </li>
                <li>
                    <a href="{{ URL::to('gestionarproyectos/cambiarestadoproyectovista') }}">Cambiar estado a un
                        proyecto</a>
                </li>
                <li>
                    <a href="{{ URL::to('gestionarproyectos/buscarusuariosvista') }}">Buscar Usuarios</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo6"><i class="fa fa-fw fa-arrows-v"></i>
                Gestionar cuentas titulares <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo6" class="collapse">
                <li>
                    <a href="{{ URL::to('gestionarproyectos/modificarcuentatitularvista') }}">Modificar cuentas titulares</a>

                </li>
                <li>
                    <a href="{{ URL::to('gestionarproyectos/consultarcuentatitularvista') }}">Consultar cuentas titulares</a>

                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo7"><i class="fa fa-fw fa-arrows-v"></i>
                Gestionar cuentas colaboradoras<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo7" class="collapse">
                <li>
                    <a href="{{ URL::to('gestionarcuentascolaboradoras/agregarcuentascolaboradoras') }}">Agregar cuentas colaboradora</a>

                </li>
                <li>
                    <a href="{{ URL::to('gestionarcuentascolaboradoras/modificarcuentacolaboradoravista') }}">Modificar cuentas colaboradora</a>

                </li>

                <li>
                    <a href="{{ URL::to('gestionarcuentascolaboradoras/consultarcuentacolaboradoravista') }}">Consultar cuentas colaboradora</a>

                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-arrows-v"></i>
                Gestionar dependencias <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo2" class="collapse">

                <li>
                    <a href="{{ URL::to('gestionardependencias/daraltadependecia') }}">Dar de alta una dependencia</a>

                </li>

                <li>
                    <a href="{{ URL::to('gestionardependencias/darbajadependencia') }}">Dar baja una dependencia</a>

                </li>
                <li>
                    <a href="{{ URL::to('gestionardependencias/consultardependenciasvista') }}">Consultar
                        dependencias</a>

                </li>

                <li>
                    <a href="{{ URL::to('gestionardependencias/modificardependenciasvista') }}">Modificar
                        una dependencia</a>
                </li>



            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo3"><i class="fa fa-fw fa-arrows-v"></i>
                Generar reportes <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo3" class="collapse">
                <li>
                    <a href="{{ URL::to('generarreportes/contabilidadmensualproyectos') }}">Contabilidad mensual para
                        proyectos</a>

                </li>
                <li>
                    <a href="{{ URL::to('generarreportes/contabilidadporperiodoproyectos') }}">Contabilidad por periodo
                        para proyectos</a>

                </li>
                <li>
                    <a href="{{ URL::to('generarreportes/contabilidadmensualdependencias') }}">Contablidad mensual para
                        dependencias</a>
                </li>
                <li>
                    <a href="{{ URL::to('generarreportes/contabilidadporperiododependencias') }}">Contabilidad por
                        periodo para dependencias</a>

                </li>


            </ul>
        </li>


        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo5"><i class="fa fa-fw fa-arrows-v"></i>
                Consultar recursos disponibles <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo5" class="collapse">
                <li>
                    <a href="{{ URL::to('consultarrecursosdisponibles/recursosdisponiblesproyectos') }}">Recursos
                        consumidos</a>
                </li>
                <li>
                    <a href="{{ URL::to('consultarrecursosdisponibles/consumorecursosmiztli') }}">Consumo de recursos
                        Miztli</a>
                </li>
            </ul>
        </li>


        <li>
            <a href="{{ URL::to('subircontabilidad') }}">Subir Archivo de contabilidad</a>

        </li>

        <li>
            <a href="{{ URL::to('asignarconvocatoria') }}">Asignar Convocatoria</a>

        </li>

        <li>
            <a href="{{ URL::to('gestionarcuentaslogin/mostrarobfuscarcuentasmaquina') }}">Obfuscar cuentas maquina</a>

        </li>

        <li>
            <a href="{{ URL::to('gestionarcuentaslogin/mostrarobfuscarcuentasvpn') }}">Obfuscar cuentas vpn</a>

        </li>

        <li>
            <a href="{{ URL::to('reasignarpassword/mostrarreasignarpassword') }}">Reasignar password</a>

        </li>





    </ul>
</div>
<!-- /.navbar-collapse -->
</nav>

@yield('content')

</div>
<!-- /#wrapper -->


</body>

</html>
