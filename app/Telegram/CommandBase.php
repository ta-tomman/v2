<?php

namespace App\Telegram;

use Telegram\Bot\Commands\Command;

abstract class CommandBase extends Command
{
    protected function appendReplyToMessageId($param)
    {
        if (!isset($param['reply_to_message_id'])) {
            $replyId = $this->getUpdate()->getMessage()->getMessageId();
            $param['reply_to_message_id'] = $replyId;
        }

        return $param;
    }

    public function replyWithMessage($param)
    {
        $param = $this->appendReplyToMessageId($param);
        parent::replyWithMessage($param);
    }

    public function replyWithPhoto($param)
    {
        $param = $this->appendReplyToMessageId($param);
        parent::replyWithPhoto($param);
    }
}
