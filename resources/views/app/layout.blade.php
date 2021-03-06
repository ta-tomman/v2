<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="/favicon.ico">
  <title>TOMMAN</title>

  <!-- Bootstrap Core CSS -->
  {{--<link href="/tpl/eliteadmin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">--}}
  <!-- This is Sidebar menu CSS -->
  {{--<link href="/tpl/eliteadmin/plugins/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">--}}
  <link rel="stylesheet" href="/css/vendor.css">

  @yield('style-import')

  <!-- This is a Animation CSS -->
  <!--<link href="/tpl/eliteadmin/css/animate.css" rel="stylesheet">-->
  <!-- This is a Custom CSS -->
  {{--<link id="style-custom" href="/tpl/eliteadmin/css/style.css" rel="stylesheet">--}}
  <!-- color CSS you can use different color css from css/colors folder -->
  {{--<link href="/tpl/eliteadmin/css/colors/gray.css" id="theme"  rel="stylesheet">--}}
  <link id="style-tpl" rel="stylesheet" href="/tpl/eliteadmin/css/eliteadmin.css">

  <link rel="stylesheet" href="/css/app.css">

  @yield('style')

</head>
<body class="fix-sidebar">

{{--<div class="preloader">--}}
  {{--<div class="cssload-speeding-wheel"></div>--}}
{{--</div>--}}

<div id="wrapper">
  <div class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
      <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
      <div class="top-left-part">
        <a href="/" class="logo">
          <b>
            {{--<img src="/img/logo.png" height="52" alt="TA">--}}
          </b>
          <span class="hidden-xs">
            {{--<img src="/img/tomman.png" height="52" alt="TOMMAN">--}}
          </span>
        </a>
      </div>
      <ul class="nav navbar-top-links navbar-right pull-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle profile-pic" data-toggle="dropdown">
            <span class="hidden-xs">
              <!-- TODO: profile pic -->
              <?php $authSessionKey = \App\Http\Controllers\Authorization\LoginController::SESSION_KEY ?>
              {{ session($authSessionKey)->nama }}
            </span>
          </a>
          <ul class="dropdown-menu dropdown-user">
            <li>
              <a href="/logout">
                <i class="fa fa-power-off"></i>
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
      <ul class="nav" id="side-menu">
        <li>
          <a href="/mcore">
            <span class="hide-menu">MCore</span>
          </a>
        </li>
        <li>
          <a href="/shell-test">
            <span class="hide-menu">Shell Test</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div id="page-wrapper">
    <div class="container-fluid">
      @include('partial.alerts')

      @yield('body')

      <footer class="footer text-center">TOMMAN &copy; <!--Telkom Akses Banjarmasin--></footer>
    </div>
  </div>
</div>

<!-- jQuery -->
{{--<script src="/tpl/eliteadmin/plugins/jquery/dist/jquery.min.js"></script>--}}
<!-- Bootstrap Core JavaScript -->
{{--<script src="/tpl/eliteadmin/bootstrap/dist/js/bootstrap.min.js"></script>--}}
<!-- Sidebar menu plugin JavaScript -->
{{--<script src="/tpl/eliteadmin/plugins/sidebar-nav/dist/sidebar-nav.min.js"></script>--}}
<!--Slimscroll JavaScript For custom scroll-->
{{--<script src="/tpl/eliteadmin/js/jquery.slimscroll.js"></script>--}}
<!--Wave Effects -->
{{--<script src="/tpl/eliteadmin/js/waves.js"></script>--}}
<!-- Custom Theme JavaScript -->
{{--<script src="/tpl/eliteadmin/js/custom.min.js"></script>--}}
<script src="/tpl/eliteadmin/js/eliteadmin.js"></script>
<script>
  if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('sw.js');
  }
</script>
@yield('script')
</body>
</html>
