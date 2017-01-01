<?php

namespace App\Telegram;

use App\Service\Ipayment;

class IpaymentCommand extends CommandBase
{
    protected $name = 'ipayment';
    protected $description = 'data tagihan pelanggan dari I-Payment';

    public function handle($param)
    {
        try {
            $jastel = trim($param);
            $result = Ipayment::request($jastel);
        }
        // error handling
        catch (\InvalidArgumentException $e) {
            $this->replyWithMessage([
                'text' => "silahkan input nomor jastel, misal:\n`/ipayment 051112345`\n`/ipayment 161123154654`",
                'parse_mode' => 'Markdown'
            ]);
        }

        // TODO: process $result into view
    }
}