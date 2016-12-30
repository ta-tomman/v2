<?php

namespace App\Telegram;

use Telegram\Bot\Commands\Command;

class DebugCommand extends Command
{
    protected $name = 'debug';
    protected $description = 'DEBUG other command';

    public function handle($param)
    {
        $token = explode(' ',$param);
        $idekey = $token[0];
        $arg = implode(' ', array_slice($token, 1));

        $apikey = env('TELEGRAM_BOT_TOKEN');
        $host = explode('://', env('APP_URL'))[1];
        $url = ("https://localhost/hook/{$apikey}?XDEBUG_SESSION_START={$idekey}");

        $update = json_decode(json_encode($this->getUpdate()));
        $update->message->text = $arg;
        $json = json_encode($update);

        $cmd = 'nohup curl -k -H "Host: '.$host.'" -H "Content-Type: application/json" -X POST -d \''.$json.'\' '.$url.' > /dev/null 2>&1 &';
        exec($cmd);
    }
}