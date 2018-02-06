<?php
/**
 * Created by PhpStorm.
 * User: mattin
 * Date: 2/5/18
 * Time: 20:46
 */
include "Bot.php";
include "Message/TextMessage.php";
include "Message/PhotoMessage.php";
include "Keyboard/InlineKeyboard.php";
include "Keyboard/NormalKeyboard.php";
include "Keyboard/ForceReply.php";
include "Edit/DeleteMessage.php";


$bot = new Bot("323067439:AAGIWw5rgGnFS3BiwAsN_9oUpOwTyNqbMJ8");

$bot->getUpdate();
$res =  ($bot->getResult(1));
$message_id =  $bot->getMessage_id($res);
$chat_id = $bot->getChat_id($res);
$reply = $bot->getRepliedMessageText($res);


$message = new TextMessage($chat_id , $reply);
$message->setReplyToMessageId($message_id);
$message->unNotifyUser();
$message->setReplyMarkup(new NormalKeyboard([["salam"]]));
$bot->send($message);
//$id = $bot->getChat_id($bot->getResult(0));
//$message = new TextMessage($id, "salam");
//
//$bot->send($message);
