"use strict";

var CACHE_NAME = 'TOMMANv2-DEBUG';
var CACHE_VERSION = '1';

self.oninstall = function(event) {};

self.onactivate = function(event) {
  var currentCacheName = CACHE_NAME + '-cache-v' + CACHE_VERSION;
  caches.keys().then(function(cacheNames) {
    return Promise.all(
      cacheNames.map(function(cacheName) {
        if (cacheName !== currentCacheName)
          return caches.delete(cacheName);
      })
    )
  })
};

self.onfetch = function(event) {};
