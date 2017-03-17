<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="/favicon.png">
  <title>ERROR - TOMMAN</title>

  <!-- Bootstrap Core CSS -->
  <link href="/tpl/eliteadmin-modern/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  @yield('style-import')

  <!-- This is a Animation CSS -->
  <link href="/tpl/eliteadmin-modern/css/animate.css" rel="stylesheet">
  <!-- This is a Custom CSS -->
  <link href="/tpl/eliteadmin-modern/css/style.css" rel="stylesheet">
  <!-- color CSS you can use different color css from css/colors folder -->
  <link href="/tpl/eliteadmin-modern/css/colors/default.css" id="theme"  rel="stylesheet">

  @yield('style')

</head>
<body>

<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>

<div id="wrapper" class="error-page">
  <div class="error-box">
    <div class="error-body text-center">
      @yield('body')

      <footer class="footer text-center">Tomman &copy; Telkom Akses Banjarmasin</footer>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="/tpl/eliteadmin-modern/plugins/jquery/dist/jquery.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/tpl/eliteadmin-modern/js/custom.min.js"></script>
@yield('script')
</body>
</html>
