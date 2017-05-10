@extends('app.layout')

@section('body')
  <div id="app-shell-placeholder">APP SHELL</div>
  <div id="shell-loading"></div>
@endsection

@section('script')
  <script>
    // TODO: cache and network
    $(function() {
      var url = '/partial' + window.location.pathname;
      var request = new Request(url);
      var lastModified = false;
      var shellBodyEl = document.getElementById('app-shell-placeholder');

      caches.match(request).then(function(response) {
        if (!response) return;

        lastModified = response.headers.get('Last-Modified');
        response.text().then(function(responseBody) {
          shellBodyEl.innerHTML = responseBody;
        });
      });

      fetch(
        request,
        { credentials: 'include' }
      ).then(function(response) {
        var responseModified = response.headers.get('Last-Modified');
        if (lastModified == responseModified) {
          document.getElementById('shell-loading').style.display = 'none';
          return;
        }

        response.text().then(function(body) {
          var $dom = $(body);

          var $importStyles = $dom.find('partial-style-import').children();
          var refStyleEl = document.getElementById('style-custom');
          var headEl = refStyleEl.parentNode;
          $importStyles.each(function(index, el) {
            headEl.insertBefore(el, refStyleEl);
          });

          var $styles = $dom.find('partial-style').children();
          $styles.each(function(index, el) {
            headEl.appendChild(el);
          });

          var $body = $dom.find('partial-body');
          shellBodyEl.innerHTML = $body.html();

          var $scripts = $dom.find('partial-script').children();
          $scripts.each(function(index, el) {
            document.body.appendChild(el);
          });

          document.getElementById('shell-loading').style.display = 'none';
        });
      }).catch(function(error) {
        console.log('fetch:err', error);
      });

      /*$.get(
        url,
        function(response) {
          var $dom = $(response);

          var $importStyles = $dom.find('partial-style-import').children();
          var refStyleEl = document.getElementById('style-custom');
          var headEl = refStyleEl.parentNode;
          $importStyles.each(function(index, el) {
            headEl.insertBefore(el, refStyleEl);
          });

          var $styles = $dom.find('partial-style').children();
          $styles.each(function(index, el) {
              headEl.appendChild(el);
          });

          var $body = $dom.find('partial-body');
          shellBodyEl.innerHTML = $body.html();

          var $scripts = $dom.find('partial-script').children();
          $scripts.each(function(index, el) {
            document.body.appendChild(el);
          });
        }
      );*/
    });
  </script>
@endsection
