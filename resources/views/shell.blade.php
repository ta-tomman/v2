@extends('app.layout')

@section('body')
  <div id="app-shell-placeholder">APP SHELL</div>
@endsection

@section('script')
  <script>
    $(function() {
        var url = '/partial' + window.location.pathname;
        $.get(
            url,
            function(response) {
              console.log(response);
              console.log($('body', response));
              window.resp = response;
            },
            'xml'
        );
    });
  </script>
@endsection
