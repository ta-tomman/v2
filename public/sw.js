"use strict";

var CACHE_NAME = 'DEBUG-TOMMANv2-CACHEv1';

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
           &&
          url.pathname.indexOf('/partial/') !== 0 // partial request
        ) {
          return caches.match('/app-shell');
        }
      }

      return fetch(request);
    })
  )
};
