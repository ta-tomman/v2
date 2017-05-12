"use strict";
/* jshint esversion: 6 */
/* jshint worker:true */

var CACHE_NAME = 'SWv1';

self.oninstall = function(event) {
  var urls = [
    '/app-shell',

    '/tpl/eliteadmin/bootstrap/dist/css/bootstrap.min.css',
    '/tpl/eliteadmin/plugins/sidebar-nav/dist/sidebar-nav.min.css',
    '/tpl/eliteadmin/css/style.css',
    '/tpl/eliteadmin/css/colors/gray.css',

    '/css/app.css'
  ];

  var requests = urls.map(url => {
    return new Request(url, { credentials: 'include' });
  });

  event.waitUntil(
    caches
      .open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(requests);
      })
  );
};

self.onactivate = function(event) {
  var currentCacheName = CACHE_NAME;
  caches.keys().then(cacheNames => {
    return Promise.all(
      cacheNames.map(cacheName => {
        if (cacheName !== currentCacheName)
          return caches.delete(cacheName);
      })
    );
  });
};

self.onfetch = function(event) {
  var request = event.request;

  event.respondWith(
    caches.match(request).then(response => {
      if (response) {
        return response;
      }

      var url = new URL(request.url);
      if (url.host === this.location.host) {
        if ( // ignores:
          url.pathname.indexOf('.') === -1 // file with extension
          && url.pathname.indexOf('/partial/') !== 0 // partial request
          && url.pathname.indexOf('/login') !== 0
          && url.pathname.indexOf('/logout') !== 0
        ) {
          return caches.match('/app-shell');
        }
      }

      // necessary to prevent error in chrome 59, untested in firefox
      if (url.pathname.indexOf('/login') === 0 || url.pathname.indexOf('/logout') === 0) {
        var req = new Request(request.url, {
          method: request.method,
          headers: request.headers,
          mode: 'same-origin',
          credentials: request.credentials,
          redirect: 'manual'
        });
        return fetch(request);
      }

      return fetch(request, { credentials: 'same-origin' });
    })
  );
};
