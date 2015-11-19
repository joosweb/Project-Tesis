<?php
session_start();
require('clases/funciones.php');
if(!$_SESSION['rut']){
    header('Location: login.php');
    exit();
}
$m = new Mantenedores();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Bootstrap Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file :// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<style type="text/css">
    li > a {
        color:#999;
    }
</style>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Arauco</span></a>
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
                                        <h5 class="media-heading"><strong><?php echo $_SESSION['nombre']; ?></strong>
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
                                        <h5 class="media-heading"><strong><?php echo $_SESSION['nombre']; ?></strong>
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
                                        <h5 class="media-heading"><strong><?php echo $_SESSION['nombre']; ?></strong>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['nombre']; ?> <b class="caret"></b></a>
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
                            <a href="pages/logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-home"></i> Inicio</a>
                    </li>
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Reportes"><i class="fa fa-bar-chart"></i> Generar Reportes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Reportes" class="collapse">
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Inspecciones"><i class="fa fa-fw fa-arrows-v"></i> Inspecciones <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Inspecciones" class="collapse">
                            <li>
                                <a href="#">Realizadas</a>
                            </li>
                            <li>
                                <a href="#">No Realizadas</a>
                            </li>
                        </ul>
                            </li>
                        </ul>
                   
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Graficas"><i class="fa fa-pie-chart"></i> Generar Graficas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Graficas" class="collapse">
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#fallas"><i class="fa fa-fw fa-arrows-v"></i> Fallas Registradas <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="fallas" class="collapse">
                            <li>
                                <a href="#">Planificadas</a>
                            </li>
                            <li>
                                <a href="#">Emergencia</a>
                            </li>
                        </ul>
                            </li>
                        </ul>
                   
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Variables"><i class="fa fa-eye"></i> Visualizar Variables <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Variables" class="collapse">
                            <li>
                                <a href="#">Temperatura</a>
                            </li>
                            <li>
                                <a href="#">Vibración</a>
                            </li>
                        </ul>                
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ins"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Inspección <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ins" class="collapse">
                            <li>
                                <a href="#">Generar Inpección</a>
                            </li>
                             <li>
                                <a href="#">Inspecciones Actuales</a>
                            </li>
                        </ul>                
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Mantenedores"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Mantenedores <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Mantenedores" class="collapse">
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Usuario"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuario <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Usuario" class="collapse">
                            <li>
                                <a href="index.php?s=adduser">Ingresar nuevo usuario</a>
                            </li>
                            <li>
                                <a href="index.php?s=moduser">Modificar Usuario</a>
                            </li>                             
                             </ul>
                             <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Area"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> Area <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Area" class="collapse">
                            <li>
                                <a href="index.php?s=addarea">Ingresar Area</a>
                            </li>
                            <li>
                                <a href="index.php?s=modarea">Modificar Area</a>
                            </li>                             
                             </ul>
                             <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Maquina"><span class="glyphicon glyphicon-scale" aria-hidden="true"></span> Maquina <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Maquina" class="collapse">
                            <li>
                                <a href="index.php?s=addmaquina">Ingresar Maquina</a>
                            </li>
                            <li>
                                <a href="index.php?s=modmaquina">Modificar Maquina</a>
                            </li>                             
                             </ul>
                             <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Equipo"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Equipo <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Equipo" class="collapse">
                            <li>
                                <a href="index.php?s=adduser">Ingresar Equipo</a>
                            </li>
                            <li>
                                <a href="index.php?s=moduser">Modificar Equipo</a>
                            </li>                             
                             </ul>
                            </li>
                        </ul>
                   
                    </li>
                    <!-- SUBMENU -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php

                    $site = addslashes(htmlentities($_GET["s"]));

                    if($site && $site != "") {
                        switch($site) {
                            case "home":
                                $href = "pages/home.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                           case "adduser":
                                $href = "pages/mantenedores/adduser.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                           case "moduser":
                                $href = "pages/mantenedores/moduser.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                          case "addarea":
                                $href = "pages/mantenedores/addarea.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                         case "modarea":
                                $href = "pages/mantenedores/modarea.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                        case "addmaquina":
                                $href = "pages/mantenedores/addmaquina.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                        case "modmaquina":
                                $href = "pages/mantenedores/modmaquina.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;       

                                default:
                                include("pages/404.php");   
                                }
                            } else {
                                include("pages/home.php");
                        }
                ?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Morris Charts JavaScript -->
    
</body>
</html>