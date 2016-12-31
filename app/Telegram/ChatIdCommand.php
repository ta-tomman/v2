<?php

namespace App\Telegram;

class ChatIdCommand extends CommandBase
{
    protected $name = 'chatid';
    protected $description = 'Nomor ID dari Chat yang aktif';

    public function handle($param)
    {
        $id = $this->getUpdate()->getMessage()->getChat()->getId();

        $this->replyWithMessage([
            'text' => "ChatID: `$id`",
            'parse_mode' => 'Markdown'
        ]);
    }
}