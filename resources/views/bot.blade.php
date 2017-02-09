<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>TOMMANv2</title>

  <?php $baseurl = config('app.url') ?>
  <link href="{{ $baseurl }}/tpl/eliteadmin-modern/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ $baseurl }}/tpl/eliteadmin-modern/css/style.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      background-color: #edf1f5;
    }
    #page-wrapper {
      margin-left: 0;
      padding-top: 15px;
      min-height: 100%;
    }
    #logo {
      text-align: right;
      margin: 10px 13px;
    }
  </style>
  @yield('style')
</head>
<body>
  <div id="logo"><img src="{{ $baseurl }}/img/tomman.png" alt="TOMMAN"></div>
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        @yield('body')
      </div>
    </div>
  </div>
</body>
</html>
