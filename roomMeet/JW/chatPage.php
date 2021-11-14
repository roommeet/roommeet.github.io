<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
    crossorigin="anonymous">

   


    <script src="https://unpkg.com/vue@next"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>
    <!-- WILL HAVE TO CHANGE PATH FOR THIS SHEET -->
    <link rel="stylesheet" href="./stylesheets/login.css">
    <link rel="stylesheet" href="./stylesheets/main.css">
    <link rel="stylesheet" href="./stylesheets/chat.css">

    <style>
        /* CHANGE PATH FOR THE IMAGE */
        .mainbg {
            background: url("./img/bg3.jpg") no-repeat center;
            background-size: cover;
            background-position: fixed;
            width: 100%;
            height: 100vh; 
        }
    </style>

</head>
<body>
    <?php
    include_once "common.php";

    // REDIRECT IF NOT LOGGED IN
    // if(!isset($_SESSION["username"])){
    //     header("Location: home.html");
    // }
    $sessionEmail = "apple2020";
    $chatDAO = new chatDAO();
    
    // NEED LINK TO USER DATABASE GET NAME WHERE ID = RECEIVERID
    
    $userDAO = new userDAO();
    $sessionUser = $userDAO ->get($sessionEmail);
    $sessionId = $sessionUser->getUserId();
    $sessionName = $sessionUser->getName();
    // var_dump($sessionId,$sessionName);

    // $chat_history = $chatDAO -> get("JosephMary");
    $chat_history = $chatDAO -> getAll();
    // var_dump($chat_history);

    $usersArray = [];
    $chats = [];
    foreach($chat_history as $item){
        // var_dump($item);
        $string = $item->getChat_string();
        // var_dump($string);
        $userId = $item->getUserId();
        // var_dump($userId);
        $receiverId = $item->getReceiverId();
        // var_dump($userId);
        $user = $userDAO ->getWithId($userId);
        // var_dump($user);
        $receiver = $userDAO -> getWithId($receiverId);
        $userEmail = $user->getEmail();
        $userName = $user->getName();
        // var_dump($userEmail);
        // var_dump($userName);
        $receiverEmail = $receiver->getEmail();
        $receiverName = $receiver->getName();
        $usersArray[$userId] = [];
        $usersArray[$receiverId] = [];
        if(!in_array($receiverEmail, $usersArray[$receiverId])){
            $usersArray[$receiverId][] = $receiverEmail;
            $usersArray[$receiverId][] = $receiverName;
        }
        if(!in_array($userEmail, $usersArray[$userId])){
            $usersArray[$userId][] = $userEmail;
            $usersArray[$userId][] = $userName;
        }
        // var_dump($usersArray);
        $users = [];
        $users[] = $userId;
        $users[] = $receiverId;
        sort($users);
        $usersConcatenate = strval($users[0]).strval($users[1]);
        // var_dump($usersConcatenate);
        // var_dump($users);
        if($receiverEmail == $sessionEmail || $userEmail == $sessionEmail){
            $chats[$usersConcatenate][] = $string."</s>".$userName;}
            // var_dump($chats);
    }
    // var_dump($usersArray);
    // var_dump($chats);
    foreach($chats as $key=>$value){
        // var_dump(strval($key), $value);
        $recipient = str_replace($sessionId, "", $key); 
        $recipientName = $usersArray[$recipient][1];
        // var_dump($recipientName);
        $long_string = "";
        foreach($value as $strings){
            $long_string.= "</br>". $strings;
        }
        $long_string = trim($long_string, "</br>");
        // var_dump($long_string);
        echo("<input class = 'chatting' type = 'hidden' name = '$recipient,$recipientName' value = '$long_string'>");
        
    }
    echo "<input id = 'identifier' type = 'hidden' name = '$sessionName,$sessionId'>";
    ?>



    <div class="homecontainer-fluid" id='app'>
        <div id="window" class="window">
            <!-- LOGIN FORM -->
            <my-login></my-login>
            <!-- REGISTER FORM -->
            <my-register></my-register>
        </div>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a href="../sean2/home.php" class="navbar-brand" id="logoname">ROOMMEET.</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto" v-if="user == null">
                        <li class="nav-item">
                            <a href="#login" onclick="openLoginForm()" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="#register" class="nav-link" onclick="openRegisterForm()" >Register</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#browse" class="nav-link">Browse</a>
                        </li>
                        <li class="nav-item">
                            <a href="#listings" class="nav-link">Listings</a>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav ms-auto" v-else>
                        <li class="nav-item" style="margin:auto; padding: auto;">
                            <b>Welcome, {{user.username}}! </b>
                        </li>
                        <li class="nav-item">
                            <a href="../JW/chatPage.php" class="nav-link">Chat</a>
                        </li>
                        <li class="nav-item">
                            <a href="../listing/view-listing.php" class="nav-link">Listings</a>
                        </li>
                        <li class="nav-item">
                            <a href="./profile.php" class="nav-link">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="" onclick="logoutMsg(); doLogout();" class="nav-link">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    
    </div>        
    

    <div class = "mainbg">
    <div class = "homecontainer text-center">
        
        <div id = "chatHeader">
            <h2>CHAT</h2>
        </div>
    </div>
        <div class = "row">
        
            <div id = "chatList" class="btn-group-vertical d-inline-block col-2" data-toggle="buttons" role="group" aria-label="Basic radio toggle button group"></div>
        
            <div class = "col-7" classname="chat" id = "history"></div>
            <div class = "col-5"></div>
        </div>
        <div class = "row">
    
            <div class = "container">
                <div class = "row">
                    <div class = "col-2"></div>
                    <div class = "col-10" id = "send"></div>
                </div>
            </div>
            
        </div>
    </div>
    
    

    <script>
        var chats = document.getElementsByClassName("chatting");
        var chatArray = [];
        // console.log(chats[2])
        for(chat of chats){
            // console.log(test.value)
            split_string = chat.value.split("</br>");
            chatArray[chat.name] = split_string
            
            // console.log(chatArray)
        }
        // console.log(chatArray)
        for (var key in chatArray){
            // console.log( key); 
            splitKey = key.split(",");
            var para = document.createElement("input");
            para.type = "button";
            // set id attribute     
            para.id = splitKey[1];
            para.value = splitKey[1];
            para.name = splitKey[0];
            para.className ="btn btn-secondary btn-lg text-dark"; 
            para.dataset.toggle = "button";
            // console.log(splitKey[0]);
            var element = document.getElementById("chatList");
            element.appendChild(para);
            // console.log(element)
            
            target = document.getElementById(splitKey[1])
            // console.log(target)
            target.addEventListener("click", function(){
                hideHistory(this.id);
                showHistory(this.id, this.name);
            })
        }


        function showHistory(id, name){
            // console.log(id, name) 

            var chats = document.getElementsByClassName("chatting");
            var chatHistory = document.getElementById("history");
            // var message = document.createElement("h2");
            // message.className = "text-right";
            // var node = document.createTextNode(id);
            // message.appendChild(node);
            // chatHistory.appendChild(message);
            var header = document.getElementById("chatHeader");
            var chatHeader = document.createElement("h2");
            var headerText = "Chat - " + id
            // console.log(header)
            var headerNode = document.createTextNode(headerText)
            chatHeader.appendChild(headerNode);
            header.appendChild(chatHeader);

            
            for(chat of chats){
                // console.log(chat)
                var splitKey = chat.name.split(",");
                if(splitKey[1] == id){
                    // console.log(chat.name, id)
                    // console.log(chat)
                    texts = chat.value.split("</br>")
                    // console.log(texts)
                    for(text of texts){
                        var message = text.split("</s>")
                        var para = document.createElement("p");
                        var wrapMsg = document.createElement("div");
                        wrapMsg.className = "chat__wrapper";
                        var chatMsg = document.createElement("div");
                        
                        // console.log(id);
                        // split the two and concatenate Sender:Message
                        // console.log(message[1]);

                        
                        if(message[1] === id){
                            chatMsg.className = "chat__message";
                            var node = document.createTextNode(message[0]);
                            chatMsg.appendChild(node);
                            wrapMsg.appendChild(chatMsg);
                            para.appendChild(wrapMsg);
                            chatHistory.append(para);
                        }
                        else{
                            chatMsg.className = "chat__own_message";
                            var node = document.createTextNode(message[0]);
                            chatMsg.appendChild(node);
                            wrapMsg.appendChild(chatMsg);
                            para.className = "text-end"
                            para.appendChild(wrapMsg);
                            chatHistory.appendChild(para);
                        }
                    }
                }
            }
            var chatBox = document.createElement("input");
            chatBox.name = "message"
            chatBox.type = "text";
            chatBox.className = "message"
            chatBox.placeholder = "Message";
            // chatBox.size = "80";
            var chatBoxNode = document.createTextNode("");
            chatBox.appendChild(chatBoxNode);
            chatSend = document.getElementById("send");
            chatSend.appendChild(chatBox)
            // console.log(chatBox)


            var sending = document.getElementById("send");
            var button = document.createElement("input");
            button.type = "button";
        // set id attribute 
            button.id = "sending";
            button.value = "Send";
            button.name = "sending";
            
            button.className ="btn btn-secondary text-dark btn-toggle"; 
            sending.appendChild(button);



            var sessionInfo = document.getElementById("identifier").name;
            var sessionInfoSplit = sessionInfo.split(",");
            var username = sessionInfoSplit[0];
            // console.log(name)
            chatBox.addEventListener("keypress", function(e){
                if (e.key === "Enter"){
                    // console.log(username, name)
                    // text = document.getElementsByClassName("message")[0].value
                    sendText(username, id, name);
                }
            })
            // console.log(button)
            button.addEventListener("click", function(){
                // text = document.getElementsByClassName("message")[0].value
                // console.log(text)
                sendText(username, id, name)
            })

            
            

        }

        function hideHistory(id){
            var div1 =  document.getElementById("history");
            var children = div1.children;  // -> get all child nodes of div1     
            var len = children.length;
            
            for (let i=0; i<len; i++) {
                
                children[0].remove(); 
            }    

            var div2 =  document.getElementById("send");
            var children = div2.children;  
            var len = children.length;
        
            for (let i=0; i<len; i++) {
                
                children[0].remove(); 
            }    

            var div3 = document.getElementById("chatHeader");
            var children = div3.children;  
            var len = children.length;
        
            for (let i=0; i<len; i++) {
                
                children[0].remove(); 
            }    

        }

        function sendText(username, id, name){
            // sort by alphabetical order the concatenation of names
            // console.log(id);
            chatHistory = document.getElementById("history");
            fullText = document.getElementsByClassName("message");
            text = fullText[0].value;
            text = text.trim(" ");
            // console.log(text);
            if(text === ""){
                alert("Please enter a message!")
            }else{
            var para = document.createElement("p");
            // split the two and concatenate Sender:Message
            para.className = "text-end";
            var node = document.createTextNode(text);
            var wrapMsg = document.createElement("div");
            wrapMsg.className = "chat__wrapper";
            var chatMsg = document.createElement("div");
            chatMsg.className = "chat__own_message";
            chatMsg.appendChild(node);
            wrapMsg.appendChild(chatMsg);
            para.appendChild(wrapMsg);

        
            chatHistory.appendChild(para);
            message = text;
            // namesUser = [];
            // namesUser.push(username);
            // namesUser.push(id);
            // namesUser.sort();
            // users = namesUser[0] + namesUser[1];
            // sender = username;
            
            
            // console.log(id)
            var sessionInfo = document.getElementById("identifier").name;
            var sessionInfoSplit = sessionInfo.split(",");
            var sessionId = sessionInfoSplit[1];
            // console.log(username);
            ajaxCall(sessionId, message, name);

            

            chatting = document.getElementsByClassName("chatting");
            // console.log(chatting)
            for(let i = 0; i<chatting.length;i++){
                // console.log(chatting[i])
                splitName = chatting[i].name.split(",")
                // console.log(splitName[1]);
                if(splitName[1] === id){
                    // console.log("HI")
                    chatting[i].value += "</br>" + text + "</s>" + username;
                    // chatting_value = chatting[i].value;
                    // chatting_value+="</br>" + text + "</s>" + username;
                    // chatting[i].value = "";
                    // console.log(chatting[i].value)
                }
            }
        }
            fullText[0].value = "";

        
        }
        
        function ajaxCall(userId, message, receiverId) {
            var userIdjs = userId;
            var messagejs = message;
            var receiverIdjs = receiverId;
            // console.log(userIdjs, messagejs, receiverIdjs)
            $.ajax({
            type: 'POST',
            url: 'chatDAO.php',
            dataType: "json",
            data: {
            userId: userIdjs,
            message: messagejs,
            receiverId: receiverIdjs
            },
            success: function(response) {
                // console.log(response);
            }
            });
        }
    </script>



    <script>
        function htmlEntities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
    </script>





    <!-- <div id="chat">
        <h1>{{ recipient }}</h1>
        <chat-history>


        </chat-history>
    </div> -->
    
    <script src = "../sean2/home.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>
</body>
</html>