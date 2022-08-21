<?php
// Includde the autoloader
include '../vendor/autoload.php';
// Load Config
$jsonConfig = file_get_contents("../config/config.json");
$config = json_decode($jsonConfig, true);


$telegram = new Telegram($config->telegramToken);
$chat_id = $telegram->ChatID();
$text = $telegram->Text();

if ($text == '/zitat@strombergapi_bot') {
    $text = getRandomZitat();
    $content = ['chat_id' => $chat_id, 'photo' => 'https://assets.deutschlandfunk.de/FILE_96f808ea3505c4ae16aac5e51d4ebba2/1920x1080.jpg?t=1597584255401', 'caption' => $text];;
    $telegram->sendPhoto($content);
}

function getRandomZitat () {
    $apiURL = "https://www.stromberg-api.de/api/quotes/random";
    $json = file_get_contents($apiURL);
    $obj = json_decode($json);
    return $obj->quote;
}
?>