"use strict";

var CACHE_NAME = 'TOMMANv2-DEBUGv1';

self.oninstall = function(event) {
  var urls = [
    '/app-shell'
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
  )
};

self.onactivate = function(event) {
  console.log('sw:onactivate');
  var currentCacheName = CACHE_NAME;
  caches.keys().then(cacheNames => {
    return Promise.all(
      cacheNames.map(cacheName => {
        if (cacheName !== currentCacheName)
          return caches.delete(cacheName);
      })
    )
  })
};

self.onfetch = function(event) {
  console.log('sw:onfetch', event.request.url);
  var request = event.request;

  event.respondWith(
    caches.match(request).then(response => {
      if (response) {
        console.log('[SW:CACHED]', request.url);
        return response;
      }

      var url = new URL(request.url);
      if (url.host === this.location.host) {
        if (
          url.pathname.indexOf('.') === -1 // file with extension
           &&
          url.pathname.indexOf('/partial') !== 0 // partial request
        ) {
          console.log('[SW] App Shell Redirect');
          return caches.match('/app-shell');
        }
      }

      console.log('[SW:FETCH]', request.url);
      return fetch(request);
    })
  )
};
