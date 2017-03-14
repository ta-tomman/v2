"use strict";

process.on('unhandledRejection', e => {
  console.log('{"error":"UnhandledRejection"}');
  process.exit();
});

const Chromium = require('node-horseman');
const Promise = require('bluebird'); //Promise object
const QS = require('querystring');

const URL = 'http://telkomakses.co.id/login/';

// input validator using regex
const numberOnly = /^[0-9]+$/;

var nik = process.argv[2];
if (!numberOnly.test(nik)) {
  console.log(JSON.stringify({
    error: 'InvalidArgument:nik'
  }));
  process.exit();
}

var pass = process.argv[3];
if (!pass) {
  console.log(JSON.stringify({
    error: 'InvalidArgument:password'
  }));
  process.exit();
}

const browser = new Chromium({
  // skip images for faster loading
  loadImages: false
});

browser.on('loadFinished', status => {
  console.log('LoadFinished', status);
});
browser.on('error', (msg, trace) => {
  console.log('error', msg, trace);
});
browser.on('alert', msg => {
  console.log('alert', alert);
});

const run = Promise.coroutine(function* () {
  yield browser
    .open(URL)
    .type('input[name=username]', nik)
    .type('input[name=password]', pass)
    .click('[name=btn_masuk]')
    .waitForNextPage()
    .waitForNextPage()
  ;

  var url = yield browser.url();
  if (url == URL) {
    console.log(JSON.stringify({
      error: 'LoginFailed'
    }));
    return;
  }

  var cookies = yield browser.cookies();

  // primary output
  console.log(JSON.stringify(cookies));
});

run()
  .catch(e => {
    console.log(JSON.stringify({
      error: 'RequestFailed',
      trace: e
    }))
  })
  .finally(function() {
    browser.close();
  });
