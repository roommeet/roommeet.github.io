<?php

class ConnectionManager {
    public function connect() {
        $servername = "wadproject2021.cpukmprutvtu.ap-southeast-1.rds.amazonaws.com";
        $username = "admin";
        $password = "aplusproject";
        $dbname = "roomMeet";
        $conn = new PDO("mysql:host=wadproject2021.cpukmprutvtu.ap-southeast-1.rds.amazonaws.com;dbname=roomMeet;port=3306", "admin", "aplusproject");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // if fail, exception will be thrown
        return $conn;
    }

}