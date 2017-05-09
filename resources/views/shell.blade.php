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
          var $dom = $(response);
          var $body = $dom.find('partial-body');
          document.getElementById('app-shell-placeholder').innerHTML = $body.html();

          var $script = $dom.find('partial-script').children();
          $script.each(function(index, el) {
            if (el.tagName === 'SCRIPT') {
              var scriptEl = document.createElement('script');
              if (el.src.length > 0)
                scriptEl.src = el.src;
              else
                scriptEl.textContent = el.textContent;

              document.body.appendChild(scriptEl);
            }
            else {
              document.body.appendChild(el);
            }
          })
        }
      );
    });
  </script>
@endsection
