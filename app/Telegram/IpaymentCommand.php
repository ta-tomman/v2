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

            // TODO: process $result into view
        }
        // error handling
        catch (\InvalidArgumentException $e) {
            $this->replyWithMessage([
                'text' => "silahkan input nomor jastel, misal:\n`/ipayment 051112345`\n`/ipayment 161123154654`",
                'parse_mode' => 'Markdown'
            ]);
        }
        catch (\RuntimeException $e) {
            $this->replyWithMessage([
                'text' => 'Sambungan ke I-Payment GAGAL'
            ]);
        }
    }
}