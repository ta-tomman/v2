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
  <link href="/tpl/eliteadmin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- This is Sidebar menu CSS -->
  <link href="/tpl/eliteadmin/plugins/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">

  @yield('style-import')

  <!-- This is a Animation CSS -->
  <!--<link href="/tpl/eliteadmin/css/animate.css" rel="stylesheet">-->
  <!-- This is a Custom CSS -->
  <link href="/tpl/eliteadmin/css/style.css" rel="stylesheet">
  <!-- color CSS you can use different color css from css/colors folder -->
  <link href="/tpl/eliteadmin/css/colors/default.css" id="theme"  rel="stylesheet">

  @yield('style')

</head>
<body>

<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>

<div id="wrapper">
  <div class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"></div>
  </div>

  <div class="navbar-default sidebar">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar active">
      <ul id="side-menu" class="nav in">
        <li>
          <a href="">
            <span class="hide-menu">MCore</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div id="page-wrapper">
    <div class="container-fluid">
      @include('partial.alerts')

      @yield('body')

      <footer class="footer text-center">TOMMAN &copy; Telkom Akses Banjarmasin</footer>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="/tpl/eliteadmin/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/tpl/eliteadmin/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Sidebar menu plugin JavaScript -->
<script src="/tpl/eliteadmin/plugins/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--Slimscroll JavaScript For custom scroll-->
<script src="/tpl/eliteadmin/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
{{--<script src="/tpl/eliteadmin/js/waves.js"></script>--}}
<!-- Custom Theme JavaScript -->
<script src="/tpl/eliteadmin/js/custom.min.js"></script>
@yield('script')
</body>
</html>
