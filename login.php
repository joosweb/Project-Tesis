<?php
session_start();
if($_SESSION['rut']){
    header('Location: index.php');
    exit();
}
require('clases/funciones.php');
$class = new Logeo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" align="center">
                        <img src="http://www.lbimontagem.com.br/clientes/logos/arauco.png" alt="" style="margin:-10px; margin-left:-25px;">
                    </div>
                    <div class="panel-body">
                   <?php
                    if(isset($_POST['Entrar']) == 'Entrar'){

                    $rut = mysqli_real_escape_string($class->conexion(),$_POST['rut']);
                    $pass = mysqli_real_escape_string($class->conexion(),$_POST['password']);

                     if($class->Login($rut,$pass)){
                              echo '<div class="alert alert-dismissible alert-success">
                                      <button type="button" class="close" data-dismiss="alert">x</button>
                                      Inicio de sesión correcto!.
                                    </div>';
                              echo '<meta http-equiv="Refresh" content="2"; url="index.php" />';
                            }
                            else{
                               echo '<div class="alert alert-dismissible alert-danger">
                                      <button type="button" class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>
                                     Revise sus entradas!.
                                    </div>';
                            }
                           }
                           ?>
                        <form action="" role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="11.111.111-1" name="rut" type="text" onblur = "this.value = this.value.replace( /^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Recordarme
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" name="Entrar" value="Entrar">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
