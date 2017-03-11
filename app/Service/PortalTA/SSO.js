process.on('unhandledRejection', e => {
  console.log('{"error":"UnhandledRejection"}');
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

const run = Promise.coroutine(function* () {});

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
