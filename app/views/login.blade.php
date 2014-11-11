
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset ('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

</head>

<body>

<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->
{{ Form::open(array('route' => 'sesiones.store','class' => 'form-horizontal')) }}


<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">RSIDS</h3>
                </div>
                <div class="panel-body">


                    @if (Session::has('message'))
                    <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif

                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuario " name="usuario" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                            </div>

                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Ingresar al sistema">
                        </fieldset>

                </div>
            </div>
        </div>
    </div>
</div>
{{Form::close() }}

<div class="container">
    <footer>
        <p>&copy; UNAM</p>
    </footer>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="{{asset ('bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
