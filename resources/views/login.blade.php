<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/favicon.png">
  <title>TOMMAN Login</title>

  <!-- Bootstrap Core CSS -->
  <link href="/tpl/eliteadmin-modern/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- This is Sidebar menu CSS -->
  <link href="/tpl/eliteadmin-modern/plugins/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
  <!-- This is a Animation CSS -->
  {{--<link href="css/animate.css" rel="stylesheet">--}}
  <!-- This is a Custom CSS -->
  <link href="/tpl/eliteadmin-modern/css/style.css" rel="stylesheet">
  <!-- color CSS you can use different color css from css/colors folder -->
  <link href="/tpl/eliteadmin-modern/css/colors/default.css" id="theme"  rel="stylesheet">

</head>
<body>

<section id="wrapper" class="login-register">
  @include('partial.alerts')
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" method="post">
        {{ csrf_field() }}
        <h3 class="box-title m-b-20">Login</h3>
        <div class="form-group ">
          <div class="col-xs-12">
            <input name="nik" class="form-control" type="text" required="" placeholder="NIK SSO" value="{{ old('nik') }}" {{ strlen(old('nik')) ? '' : 'autofocus' }}>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input name="pass" class="form-control" type="password" required="" placeholder="Password" {{ strlen(old('nik')) ? 'autofocus' : '' }}>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> Remember me </label>
            </div>
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="/tpl/eliteadmin-modern/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/tpl/eliteadmin-modern/bootstrap/dist/js/bootstrap.min.js"></script>


<!--slimscroll JavaScript -->
{{--<script src="js/jquery.slimscroll.js"></script>--}}
<!--Wave Effects -->
{{--<script src="js/waves.js"></script>--}}
<!-- Custom Theme JavaScript -->
<script src="/tpl/eliteadmin-modern/js/custom.min.js"></script>
<!--Style Switcher -->
{{--<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>--}}
</body>
</html>
