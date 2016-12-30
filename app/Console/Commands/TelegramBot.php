<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Telegram\Bot\Api;

class TelegramBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:bot {json}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle Telegram Bot request in separate process';

    /**
     * Telegram API instance
     *
     * @var object
     */
    protected $api;
    /**
     * Telegram Request Object
     *
     * @var object
     */
    protected $request;

    /**
     * Array of message token
     *
     * @var array
     */
    protected $token;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->api = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->request = json_decode($this->argument('json'));
        $tgramMessage = $this->request->message;
        if (!$tgramMessage) exit();

        $tgramText = str_replace('..', ' ', $tgramMessage->text);
        $this->token = explode(' ', $tgramText);

        $command = strtolower($this->token[0]);
        $path = __DIR__."/TelegramHandler{$command}/index.php";

        try {
            if (file_exists($path)) include $path;
        }
        catch (\Exception $e) {
            $err = $e->getMessage();
            $type = explode('\\', get_class($e));
            $type = $type[count($type)-1];

            $this->reply("ERROR: *{$type}*\n`{$err}`", "Markdown");
        }
    }

    // TODO: refactor to a service
    /**
     * Reply to message specified in $this->request
     *
     * @param text string message to send
     * @param mode string telegram parse mode ('Markdown', 'HTML')
     */
    protected function reply($text, $mode = false)
    {
        $req = $this->request->message;
        $payload = [
            'chat_id' => $req->chat->id,
            'reply_to_message_id' => $req->message_id,
            'text' => $text
        ];
        if ($mode) $payload['parse_mode'] = $mode;

        $this->api->sendMessage($payload);
    }

    /**
     * Reply to message specified in $this->request
     * by sending an image
     *
     * @param imgPath string valid path to existing image
     * @param text string included caption
     */
    protected function replyWithImage($imgPath, $text = false)
    {}
}
