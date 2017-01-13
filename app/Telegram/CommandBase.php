<?php

namespace App\Telegram;

use Telegram\Bot\Commands\Command;

abstract class CommandBase extends Command
{
    public function replyWithMessage($param)
    {
        if (!isset($param['reply_to_message_id'])) {
            $replyId = $this->getUpdate()->getMessage()->getMessageId();
            $param['reply_to_message_id'] = $replyId;
        }

        parent::replyWithMessage($param);
    }

    public function renderView()
    {}

    public function renderImage()
    {}

    public function renderImageFromView()
    {}
}