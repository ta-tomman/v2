#!/usr/bin/env node

process.on('unhandledRejection', e => {
  console.log('{"error":"UnhandledRejection"}');
});

const Chromium = require('node-horseman');
const Promise = require('bluebird'); //Promise object
const QS = require('querystring');

// const URL = 'http://i-payment.telkom.co.id/script/intag_search_trems.php';
const URL = 'http://10.60.165.60/script/intag_search_trems.php';
const REQUESTER = {
  name: 'Hadi Susilo',
  addr: 'Banjarmasin',
  phone: '081253680725'
};

// input validator using regex
const numberOnly = /^[0-9]+$/;

/**
 * command line parameter
 * contoh:
 * node ipayment.js <jastel>
 * ./ipayment.js <jastel>
 */
var jastel = process.argv[2];
if (!numberOnly.test(jastel)) {
  console.log(JSON.stringify({
    error: 'InvalidArgument'
  }));
  process.exit();
}

const browser = new Chromium();
const run = Promise.coroutine(function* () {
  var param = QS.stringify({
    phone: jastel,
    via: ['DWH', 'TREMS'],

    rname: REQUESTER.name,
    raddr: REQUESTER.addr,
    rphone: REQUESTER.phone
  });

  yield browser.open(URL + '?' + param);
  // yield browser.open('http://10.60.165.60');

  var data = yield browser.evaluate(function () {
    var result;

    var infoEl = $('body > table:nth-child(2) > tbody');
    result = {
      nama: $('tr:nth-child(1) > td', infoEl).text(),
      produk: $('tr:nth-child(2) > td', infoEl).text(),
      phone: $('tr:nth-child(3) > td', infoEl).text(),
      internet: $('tr:nth-child(4) > td', infoEl).text(),
      groupId: $('tr:nth-child(5) > td', infoEl).text()
    };

    return result;
  });

  console.log(JSON.stringify(data));

});

run()
  .catch(e => {
    console.log('CATCH', require('util').inspect(e));
    /*console.log(JSON.stringify({
      error: e
    }))*/
  })
  .finally(function() {
    browser.close();
  });
