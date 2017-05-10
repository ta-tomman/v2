@extends('app')

@section('style-import')
  <link rel="stylesheet" href="/tpl/eliteadmin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">
@endsection

@section('body')
  <div class="white-box">SHELL TEST</div>
@endsection

@section('script')
  <script>
    function initMap() {
      var i = 1;
      if (i < 2)
        console.log('evaluated');
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpBjVs5NY5LZG2IkBU27VLpnSS-BAjcvM&callback=initMap"></script>
  <script src="/tpl/eliteadmin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
@endsection
