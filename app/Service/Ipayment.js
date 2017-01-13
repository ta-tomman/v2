process.on('unhandledRejection', e => {
  console.log('{"error":"UnhandledRejection"}');
});

const Chromium = require('node-horseman');
const Promise = require('bluebird'); //Promise object
const QS = require('querystring');

const URL = 'http://i-payment.telkom.co.id/script/intag_search_trems.php';
// const URL = 'http://10.60.165.60/script/intag_search_trems.php';
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

const browser = new Chromium({
  // skip images for faster loading
  loadImages: false
});

const run = Promise.coroutine(function* () {
  // build query string
  var param = QS.stringify({
    phone: jastel,
    via: ['DWH', 'TREMS'],

    rname: REQUESTER.name,
    raddr: REQUESTER.addr,
    rphone: REQUESTER.phone
  });

  yield browser.open(URL + '?' + param);

  // grab data using jquery
  var data = yield browser.evaluate(function () {
    var result;

    var infoEl = $('body > table:nth-child(2) > tbody');
    result = {
      nama: $('tr:nth-child(1) > td.value', infoEl).text(),
      produk: $('tr:nth-child(2) > td.value', infoEl).text(),
      phone: $('tr:nth-child(3) > td.value', infoEl).text(),
      internet: $('tr:nth-child(4) > td.value', infoEl).text(),
      groupId: $('tr:nth-child(5) > td.value', infoEl).text()
    };

    var history = [];
    var historyEl = $('body > table:nth-child(4) > tbody > tr');
    historyEl.each(function(i, tr) {
      //skip first entry (th row)
      if (i == 0) return;

      //baris genap: history entry
      if (i % 2) {
        var h = {
          periode: $('td:nth-child(2)', tr).text(),
          mataUang: $('td:nth-child(3)', tr).text(),
          tagihan: $('td:nth-child(4)', tr).text(),
          belumBayar: $('td:nth-child(5)', tr).text(),
          statusBayar: $('td:nth-child(6)', tr).text(),
          lokasiBayar: $('td:nth-child(7)', tr).text(),
          cicilan: $('td:nth-child(8)', tr).text(),
          tanggal: $('td:nth-child(9)', tr).text(),
          jam: $('td:nth-child(10)', tr).text()
        };
        history.push(h);
      }
      //baris ganjil: history detail
      else {
        var d = [];

        var detailEl = $('table tr', tr);
        detailEl.each(function(i, row) {
          // skip first entry (th row)
          if (i == 0) return;

          d.push({
            layanan: $('td:nth-child(1)', row).text(),
            mataUang: $('td:nth-child(2)', row).text(),
            tagihan: $('td:nth-child(3)', row).text(),
            statusBayar: $('td:nth-child(4)', row).text(),
            lokasiBayar: $('td:nth-child(5)', row).text()
          });
        });

        history[history.length - 1].detail = d;
      }
    });
    result.history = history;

    return result;
  });

  // primary output
  console.log(JSON.stringify(data));
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
