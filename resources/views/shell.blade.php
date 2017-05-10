@extends('app.layout')

@section('body')
  <div id="app-shell-placeholder">APP SHELL</div>
  <div id="shell-loading">
    <svg width='62px' height='62px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-ellipsis"><circle cx="16" cy="50" r="15" fill="#94a9ce" transform="rotate(0 50 50)"><animate id="anir11" attributeName="r" from="0" to="15" begin="0s;anir14.end" dur="0.25s" fill="freeze"></animate><animate id="anir12" attributeName="r" from="15" to="15" begin="anir11.end" dur="1.25s" fill="freeze"></animate><animate id="anir13" attributeName="r" from="15" to="0" begin="anir12.end" dur="0.25s" fill="freeze"></animate><animate id="anir14" attributeName="r" from="0" to="0" begin="anir13.end" dur="0.25s" fill="freeze"></animate><animate id="anix11" attributeName="cx" from="16" to="16" begin="0s;anix18.end" dur="0.25s" fill="freeze"></animate><animate id="anix12" attributeName="cx" from="16" to="16" begin="anix11.end" dur="0.25s" fill="freeze"></animate><animate id="anix13" attributeName="cx" from="16" to="50" begin="anix12.end" dur="0.25s" fill="freeze"></animate><animate id="anix14" attributeName="cx" from="50" to="50" begin="anix13.end" dur="0.25s" fill="freeze"></animate><animate id="anix15" attributeName="cx" from="50" to="84" begin="anix14.end" dur="0.25s" fill="freeze"></animate><animate id="anix16" attributeName="cx" from="84" to="84" begin="anix15.end" dur="0.25s" fill="freeze"></animate><animate id="anix17" attributeName="cx" from="84" to="84" begin="anix16.end" dur="0.25s" fill="freeze"></animate><animate id="anix18" attributeName="cx" from="84" to="16" begin="anix17.end" dur="0.25s" fill="freeze"></animate></circle><circle cx="50" cy="50" r="15" fill="#667395" transform="rotate(0 50 50)"><animate id="anir21" attributeName="r" from="15" to="15" begin="0s;anir25.end" dur="1s" fill="freeze"></animate><animate id="anir22" attributeName="r" from="15" to="0" begin="anir21.end" dur="0.25s" fill="freeze"></animate><animate id="anir23" attributeName="r" from="0" to="0" begin="anir22.end" dur="0.25s" fill="freeze"></animate><animate id="anir24" attributeName="r" from="0" to="15" begin="anir23.end" dur="0.25s" fill="freeze"></animate><animate id="anir25" attributeName="r" from="15" to="15" begin="anir24.end" dur="0.25s" fill="freeze"></animate><animate id="anix21" attributeName="cx" from="16" to="50" begin="0s;anix28.end" dur="0.25s" fill="freeze"></animate><animate id="anix22" attributeName="cx" from="50" to="50" begin="anix21.end" dur="0.25s" fill="freeze"></animate><animate id="anix23" attributeName="cx" from="50" to="84" begin="anix22.end" dur="0.25s" fill="freeze"></animate><animate id="anix24" attributeName="cx" from="84" to="84" begin="anix23.end" dur="0.25s" fill="freeze"></animate><animate id="anix25" attributeName="cx" from="84" to="84" begin="anix24.end" dur="0.25s" fill="freeze"></animate><animate id="anix26" attributeName="cx" from="84" to="16" begin="anix25.end" dur="0.25s" fill="freeze"></animate><animate id="anix27" attributeName="cx" from="16" to="16" begin="anix26.end" dur="0.25s" fill="freeze"></animate><animate id="anix28" attributeName="cx" from="16" to="16" begin="anix27.end" dur="0.25s" fill="freeze"></animate></circle><circle cx="84" cy="50" r="15" fill="#94a9ce" transform="rotate(0 50 50)"><animate id="anir31" attributeName="r" from="15" to="15" begin="0s;anir35.end" dur="0.5s" fill="freeze"></animate><animate id="anir32" attributeName="r" from="15" to="0" begin="anir31.end" dur="0.25s" fill="freeze"></animate><animate id="anir33" attributeName="r" from="0" to="0" begin="anir32.end" dur="0.25s" fill="freeze"></animate><animate id="anir34" attributeName="r" from="0" to="15" begin="anir33.end" dur="0.25s" fill="freeze"></animate><animate id="anir35" attributeName="r" from="15" to="15" begin="anir34.end" dur="0.75s" fill="freeze"></animate><animate id="anix31" attributeName="cx" from="50" to="84" begin="0s;anix38.end" dur="0.25s" fill="freeze"></animate><animate id="anix32" attributeName="cx" from="84" to="84" begin="anix31.end" dur="0.25s" fill="freeze"></animate><animate id="anix33" attributeName="cx" from="84" to="84" begin="anix32.end" dur="0.25s" fill="freeze"></animate><animate id="anix34" attributeName="cx" from="84" to="16" begin="anix33.end" dur="0.25s" fill="freeze"></animate><animate id="anix35" attributeName="cx" from="16" to="16" begin="anix34.end" dur="0.25s" fill="freeze"></animate><animate id="anix36" attributeName="cx" from="16" to="16" begin="anix35.end" dur="0.25s" fill="freeze"></animate><animate id="anix37" attributeName="cx" from="16" to="50" begin="anix36.end" dur="0.25s" fill="freeze"></animate><animate id="anix38" attributeName="cx" from="50" to="50" begin="anix37.end" dur="0.25s" fill="freeze"></animate></circle><circle cx="84" cy="50" r="15" fill="#667395" transform="rotate(0 50 50)"><animate id="anir41" attributeName="r" from="15" to="0" begin="0s;anir44.end" dur="0.25s" fill="freeze"></animate><animate id="anir42" attributeName="r" from="0" to="0" begin="anir41.end" dur="0.25s" fill="freeze"></animate><animate id="anir43" attributeName="r" from="0" to="15" begin="anir42.end" dur="0.25s" fill="freeze"></animate><animate id="anir44" attributeName="r" from="15" to="15" begin="anir43.end" dur="1.25s" fill="freeze"></animate><animate id="anix41" attributeName="cx" from="84" to="84" begin="0s;anix48.end" dur="0.25s" fill="freeze"></animate><animate id="anix42" attributeName="cx" from="84" to="16" begin="anix41.end" dur="0.25s" fill="freeze"></animate><animate id="anix43" attributeName="cx" from="16" to="16" begin="anix42.end" dur="0.25s" fill="freeze"></animate><animate id="anix44" attributeName="cx" from="16" to="16" begin="anix43.end" dur="0.25s" fill="freeze"></animate><animate id="anix45" attributeName="cx" from="16" to="50" begin="anix44.end" dur="0.25s" fill="freeze"></animate><animate id="anix46" attributeName="cx" from="50" to="50" begin="anix45.end" dur="0.25s" fill="freeze"></animate><animate id="anix47" attributeName="cx" from="50" to="84" begin="anix46.end" dur="0.25s" fill="freeze"></animate><animate id="anix48" attributeName="cx" from="84" to="84" begin="anix47.end" dur="0.25s" fill="freeze"></animate></circle></svg>
  </div>
@endsection

@section('script')
  <script>
    // TODO: cache and network
    $(function() {
      var CACHE_NAME = 'DEBUG-TOMMANv2-CACHEv1';

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
        var resp = response.clone();
        var loginUrl = window.location.origin + '/login';
        if (response.url === loginUrl) {
            window.location.href = loginUrl;
        }

        var responseModified = response.headers.get('Last-Modified');
        if (lastModified == responseModified) {
          document.getElementById('shell-loading').style.display = 'none';
          return;
        }

        caches.open(CACHE_NAME).then(function(cache) {
          cache.put(url, resp);
        });

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
