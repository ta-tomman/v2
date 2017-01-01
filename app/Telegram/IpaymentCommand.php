<?php

namespace App\Telegram;

use App\Service\Ipayment;

class IpaymentCommand extends CommandBase
{
    protected $name = 'ipayment';
    protected $description = 'data tagihan pelanggan dari I-Payment';

    public function handle($param)
    {
        $jastel = trim($param);

        // numeric only
        /*if (!preg_match('^[0-9]+$', $jastel)) {
            $this->replyWithMessage([
                'text' => 'silahkan input nomor jastel, misal:\n`/ipayment 051112345`\n`/ipayment 161123154654`',
                'parse_mode' => 'Markdown'
            ]);

            return;
        }*/

        $result = Ipayment::request($jastel);
    }
}