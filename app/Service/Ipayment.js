#!/usr/bin/env node

const Chromium = require('node-horseman');
const P = require('bluebird'); //Promise object
const QS = require('querystring');

const URL = 'http://i-payment.telkom.co.id/script/intag_search_trems.php';
const REQUESTER = {
  name: 'Hadi Susilo',
  addr: 'Banjarmasin',
  phone: '081253680725'
};

/**
 * jastel harus di-input di parameter terakhir
 * contoh:
 * node ipayment.js <jastel>
 * ./ipayment.js <jastel>
 */
var jastel = process.argv[process.argv.length-1];
if (!jastel) {
  console.log(JSON.stringify({
    error: 'silahkan input jastel'
  }));
  process.exit();
}

const browser = new Chromium();
const run = P.coroutine(function* () {
  var param = QS.stringify({
    phone: jastel,
    via: ['DWH', 'TREMS'],

    rname: REQUESTER.name,
    raddr: REQUESTER.addr,
    rphone: REQUESTER.phone
  });
  yield browser.open(URL + '?' + param);

  yield browser.evaluate(function() {
    var result = {};
    return result;
  });
});

run()
  .catch(e => {
    console.log(JSON.stringify({
      error: e
    }))
  })
  .finally(function() {
    browser.close();
  });
