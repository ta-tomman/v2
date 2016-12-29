<?php
$req = $this->request;

$idekey = $this->token[1];
$url = 'https://localhost/hook/222340979:AAGozF5JbhzsoWhBnxMCkYRKGdEK3EK5VVo?XDEBUG_SESSION_START='.$idekey;

$token = array_slice($this->token, 2);
$req->message->text = implode(' ', $token);
$json = json_encode($req);

exec('nohup curl -k -H "Host: debug.v2.tomman.info" -H "Content-Type: application/json" -X POST -d \''.$json.'\' '.$url);