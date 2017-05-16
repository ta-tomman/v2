"use strict";
/* jshint esversion: 6 */
/* jshint worker:true */

const CACHE_NAME = 'SWv1';

self.oninstall = function(event) {
  let urls = [
    '/app-shell',

    '/css/vendor.css',
    '/tpl/eliteadmin/css/eliteadmin.css',
    '/css/app.css',

    '/tpl/eliteadmin/js/eliteadmin.js',

    '/tpl/eliteadmin/less/icons/themify-icons/fonts/themify.woff?-fvbane'
  ];

  let requests = urls.map(url => {
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
  let currentCacheName = CACHE_NAME;
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
  let request = event.request;
  // necessary to prevent redirect error in chrome 59, untested in firefox
  if (request.method == 'GET') {
    request = new Request(request.url, {
      method: 'GET',
      headers: request.headers,
      mode: request.mode == 'navigate' ? 'cors' : request.mode,
      credentials: request.credentials,
      redirect: request.redirect
    });
  }

  event.respondWith(
    caches.match(request).then(response => {
      if (response) {
        return response;
      }

      let url = new URL(request.url);
      if (url.host === this.location.host) {
        if ( // ignores:
          url.pathname.indexOf('.') === -1 // file with extension
          && url.pathname.indexOf('/partial/') !== 0
          && url.pathname.indexOf('/login') !== 0
          && url.pathname.indexOf('/logout') !== 0
        ) {
          return caches.match('/app-shell');
        }
      }

      return fetch(request, { credentials: 'same-origin' });
    })
  );
};
