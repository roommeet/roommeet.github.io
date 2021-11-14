<?php
class chat{
    private $userId;
    private $chat_string;
    private $time;
    private $receiverId;

    public function __construct($userId, $chat_string, $time, $receiverId){
        $this->userId = $userId;
        $this->chat_string = $chat_string;
        $this->time = $time;
        $this->receiverId = $receiverId;
    }
    

    /**
     * Get the value of users
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of chat_string
     */ 
    public function getChat_string()
    {
        return $this->chat_string;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get the value of sender
     */ 
    public function getReceiverId()
    {
        return $this->receiverId;
    }
}

?>