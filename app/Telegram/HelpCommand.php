<?php

namespace App\Telegram;

use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    protected $name = 'help';
    protected $description = 'Help system';

    public function handle($param)
    {
        //TODO
    }

    protected function handleUnknownCommand($param)
    {
        // TODO: normalize double dot special delimeter (..)
    }

    protected function showAvailableCommand()
    {
        // TODO: ignore 'debug'
    }
}
