<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="/favicon.png">
  <title>TOMMAN</title>

  <!-- Bootstrap Core CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- This is Sidebar menu CSS -->
  <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
  @yield('style-import')
  <!-- This is a Animation CSS -->
  <link href="css/animate.css" rel="stylesheet">
  <!-- This is a Custom CSS -->
  <link href="css/style.css" rel="stylesheet">
  <!-- color CSS you can use different color css from css/colors folder -->
  <link href="css/colors/default.css" id="theme"  rel="stylesheet">
  @yield('style')

</head>
<body class="fix-sidebar">

<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>

<div id="wrapper">
  <div class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"></div>
  </div>

  <div class="side-mini-panel">
    <ul class="mini-nav">
      <div class="togglediv"><a href="javascript:void(0)" id="togglebtn"><i class="ti-menu"></i></a></div>

    </ul>
  </div>

  <div class="page-wrapper">
    <div class="container-fluid">
      @yield('body')
    </div>

    <footer class="footer text-center">TOMMAN &copy; Telkom Akses Banjarmasin</footer>
  </div>
</div>

<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Sidebar menu plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--Slimscroll JavaScript For custom scroll-->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
@yield('script')
</body>
</html>
