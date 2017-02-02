<?php

namespace App\Telegram;

class DebugCommand extends CommandBase
{
    protected $name = 'debug';
    protected $description = 'DEBUG other command';

    public function handle($param)
    {
        if (!$param) {
            $json = json_encode($this->getUpdate(), JSON_PRETTY_PRINT);
            $this->replyWithMessage([
                'text' => "`$json`",
                'parse_mode' => 'Markdown']);
        } else {
            $token = explode(' ', $param);
            $idekey = $token[0];
            $arg = implode(' ', array_slice($token, 1));

            $apikey = env('TELEGRAM_BOT_TOKEN');
            $host = $_SERVER['HTTP_HOST'];
            $url = ("https://localhost/hook/{$apikey}?XDEBUG_SESSION_START={$idekey}");

            $update = json_decode(json_encode($this->getUpdate()));
            $update->message->text = $arg;
            $json = json_encode($update);

            $cmd = 'nohup curl -k'
                 . ' -H "Host: '.$host.'"'
                 . ' -H "Content-Type: application/json"'
                 . " -X POST -d '$json'" // JSON should be single-quoted due it contains double-quote
                 . $url
                 . ' > /dev/null 2>&1 &';

            exec($cmd);
        }
    }
}
