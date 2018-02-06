<?php

/**
 * Created by PhpStorm.
 * User: masih
 * Date: 2/3/18
 * Time: 10:52 AM
 */
require_once "Message/Message.php";

class Bot
{
    private $token;
    private $offset;
    private $results = [];
    private $jsonResult;

    public function __construct($token, $offset = 0)
    {
        $this->token = $token;
        $this->offset = $offset;
    }
    public function getUpdate()
    {
        $this->jsonResult = $this->request("getUpdates", ["offset" => $this->offset]);
        $parsed = json_decode($this->jsonResult);
        if ($parsed->ok != true)
            return false;
        $this->results = $parsed->result;
        return true;
    }
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }
    public function getOffset()
    {
        return $this->offset;
    }
    public function getResults()
    {
        return $this->results;
    }
    public function getResult($index)
    {
        return $this->results[$index];
    }
    public function getJSONResult()
    {
        return $this->jsonResult;
    }
    public function send(Message $message)
    {
        return $this->request($message->getMethod(), $message->getQuery());
    }
    public function edit(Editor $editor)
    {
        return $this->request($editor->getMethod(), $editor->getQuery());
    }
    public function getChat_id($result)
    {
        return $result->message->chat->id;
    }
    public function getChat_type($result)
    {
        return $result->message->chat->type;
    }
    public function getMessage_id($result)
    {
        return $result->message->message_id;
    }
    public function getRepliedMessageId($result)
    {
        return $result->message->reply_to_message->message_id == null ? null : $result->message->reply_to_message->message_id;
    }
    public function getRepliedMessageText($result)
    {
        return $result->message->reply_to_message->text == null ? null : $result->message->reply_to_message->text;
    }
    public function getMessageText($result)
    {
        return $result->message->text;
    }
    public function getLocation($result)
    {
        return $result->message->location;
    }
    public static function getLocationLongitude($location)
    {
        return $location->longitude;
    }
    public static function getLocationLatitude($location)
    {
        return $location->latitude;
    }
    public function getVenue($result)
    {
        return $result->message->venue;
    }
    public static function getVenueTitle($venue)
    {
        return $venue->title;
    }
    public static function getVenueAddress($venue)
    {
        return $venue->address;
    }
    public static function getVenueLocation($venue)
    {
        return $venue->location;
    }
    public function getLastOffset()
    {
        return $this->results[count($this->results) - 1]->update_id;
    }
    public function request($method, $query = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot{$this->token}/{$method}");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}