<?php

namespace App\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class ChatIdCommand extends Command
{
    protected $name = 'chatid';
    protected $description = 'Nomor ID dari Chat yang aktif';

    public function handle($param)
    {
        $msg = $this->getUpdate()->getMessage();
        $id = $msg->getChat()->getId();
        $replyId = $msg->getMessageId();

        $this->replyWithMessage([
            'text' => "ChatID: `$id`",
            'parse_mode' => 'Markdown',
            'reply_to_message_id' => $replyId
        ]);
    }
}