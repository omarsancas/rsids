
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset ('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">




      <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Miztli</a>
        </div>
        <div class="navbar-collapse collapse">

        </div><!--/.navbar-collapse -->
      </div>
    </div>

   @yield('content')


<div class="container">
      <footer>
        <p>&copy; UNAM</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script src="{{asset ('js/jquery-1.4.2.js')}}"></script>
    <script src="{{asset ('js/jquery.cloneform.js')}}"></script>
    <script src="{{asset ('js/jquery.cloneform2.js')}}"></script>
    <script src="{{asset ('js/jquery.clonablefile.js')}}"></script>
    <script src="{{asset ('bootstrap/js/bootstrap.min.js')}}"></script>

    <script>
            $('#progparalela_true').click(function()
            {
                $('#numproc').removeAttr("disabled");
                $("#numproc").val(" ");
            });

            $('#progparalela_false').click(function()
            {
                $('#numproc').attr("disabled","disabled");
                $("#numproc").val("1");
            });
    </script>

  <script>
      $(' select[name=campos]').change(function(e){
          if ($(' select[name=campos]').val() == '1'){
              $('#otrocampo').show();
          }else{
              $('#otrocampo').hide();
          }
      });

  </script>



  </body>
</html>
