<?php

namespace App\Telegram;

use App\Service\Ipayment;
use App\Service\WebScreenShot;

class IpaymentCommand extends CommandBase
{
    protected $name = 'ipayment';
    protected $description = 'data tagihan pelanggan dari I-Payment';

    public function handle($param)
    {
        try {
            $jastel      = trim($param);
            $outDir      = storage_path("telegram/ipayment");
            $htmlOutPath = "{$outDir}/{$jastel}.html";
            $imgOutPath  = "{$outDir}/{$jastel}.png";

            if (file_exists($imgOutPath)) {
                $lastModified = filemtime($imgOutPath);
                $age          = time() - $lastModified;

                // consider valid for 1 hour
                if ($age < (60 * 60)) {
                    $this->replyWithPhoto([
                        'photo' => $imgOutPath
                    ]);
                    return;
                }
            }

            $this->replyWithChatAction([
                'action' => 'upload_photo'
            ]);

            $result = Ipayment::request($jastel);
            $view   = view('ipayment.view-bot', ['data' => $result]);
            $html   = $view->render();

            @mkdir($outDir, 0755, true);
            file_put_contents($htmlOutPath, $html);
            WebScreenShot::rasterizeFile($htmlOutPath, $imgOutPath);

            $this->replyWithPhoto([
                'photo' => $imgOutPath
            ]);
        } catch (\InvalidArgumentException $e) {
            $this->replyWithMessage([
                'text' => "silahkan input nomor jastel, misal:\n`/ipayment 051112345`\n`/ipayment 161123154654`",
                'parse_mode' => 'Markdown'
            ]);
        } catch (\RuntimeException $e) {
            $this->replyWithMessage([
                'text' => 'Sambungan ke I-Payment GAGAL'
            ]);
        }
    }
}
