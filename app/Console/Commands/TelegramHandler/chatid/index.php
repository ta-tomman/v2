<?php

$chatid = $this->request->message->chat->id;
$this->reply("Chat ID: `$chatid`", 'Markdown');