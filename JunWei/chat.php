<?php
class chat{
    private $users;
    private $chat_string;
    private $time;
    private $sender;

    public function __construct($users, $chat_string, $time, $sender){
        $this->users = $users;
        $this->chat_string = $chat_string;
        $this->time = $time;
        $this->sender = $sender;
    }
    

    /**
     * Get the value of users
     */ 
    public function getUsers()
    {
        return $this->users;
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
    public function getSender()
    {
        return $this->sender;
    }
}

?>