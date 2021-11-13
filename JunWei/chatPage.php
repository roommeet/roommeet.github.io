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
    <link rel="stylesheet" href="./sean2/stylesheets/login.css">
    <link rel="stylesheet" href="./sean2/stylesheets/main.css">

    <style>
        /* CHANGE PATH FOR THE IMAGE */
        .mainbg {
            background: url("./sean2/img/bg3.jpg") no-repeat center;
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
    $username = "Joseph";
    $chatDAO = new chatDAO();
    // $chat_history = $chatDAO -> get("JosephMary");
    $chat_history = $chatDAO -> getAll();
    $chats = [];
    foreach($chat_history as $item){
        // var_dump($item);
        $users = $item->getUsers();
        if(strpos($users, $username)!== false){
            $chats[$users][] = $item->getChat_string()."</s>".$item->getSender();}
    }

    foreach($chats as $key=>$value){
        // var_dump($key, $value);
        $recipient = str_replace($username, "", $key); 
        $long_string = "";
        foreach($value as $strings){
            $long_string.= "</br>". $strings;
        }
        $long_string = trim($long_string, "</br>");
        echo("<input class = 'chatting' type = 'hidden' name = '$recipient' value = '$long_string'>");
        
    }
    echo "<input id = 'identifier' type = 'hidden' name = '$username'>";
    ?>



    <div class="homecontainer-fluid" id='app'>
        <div id="window" class="window">
            <!-- LOGIN FORM -->
            <my-login></my-login>
            <!-- REGISTER FORM -->
            <my-register></my-register>
        </div>
        <!-- NAVBAR -->
        <nav-bar></nav-bar>
        
    
    </div>        
    

    <div class = "mainbg">
    <div class = "homecontainer text-center">
        <h2>CHAT</h2>
    </div>
        <div class = "row">
        
            <div id = "chatList" class="btn-group-vertical d-inline-block col-2" data-toggle="buttons" role="group" aria-label="Basic radio toggle button group"></div>
        
            <div class = "col-7" id = "history"></div>
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
        var para = document.createElement("input");
        para.type = "button";
       // set id attribute 
        para.id = key
        para.value = key;
        para.name = key;
        para.className ="btn btn-secondary btn-lg text-dark"; 
        para.dataset.toggle = "button";

        var element = document.getElementById("chatList");
        element.appendChild(para);
        // console.log(element)
        
        target = document.getElementById(key)
        // console.log(target)
        target.addEventListener("click", function(){
            hideHistory(this.id);
            showHistory(this.id)
        })
        }


        function showHistory(id){
            // console.log(id) 
            var chats = document.getElementsByClassName("chatting");
            var chatHistory = document.getElementById("history");
            var message = document.createElement("h2");
            // message.className = "text-right";
            var node = document.createTextNode(id);
            message.appendChild(node);
            chatHistory.appendChild(message);
            
            for(chat of chats){
                // console.log(chat)
                if(chat.name == id){
                    // console.log(chat.name, id)
                    // console.log(chat)
                    texts = chat.value.split("</br>")
                    // console.log(texts)
                    for(text of texts){
                        var message = text.split("</s>")
                        var para = document.createElement("p");
                        
                        // split the two and concatenate Sender:Message
                        
                        
                        if(message[1] === id){
                        var node = document.createTextNode(message[1] + ": " + message[0]);
                        para.appendChild(node);
                        chatHistory.append(para);
                        }
                        else{
                            var node = document.createTextNode(message[0]);
                            para.className = "text-end"
                            para.appendChild(node);
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
            chatBox.size = "115";
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



            var username = document.getElementById("identifier").name;
            chatBox.addEventListener("keypress", function(e){
                if (e.key === "Enter"){
                    // console.log(username, id)
                    // text = document.getElementsByClassName("message")[0].value
                    sendText(username, id);
                }
            })
            // console.log(button)
            button.addEventListener("click", function(){
                // text = document.getElementsByClassName("message")[0].value
                // console.log(text)
                sendText(username, id)
            })

            
            

        }

        function hideHistory(id){
            var div1 =  document.getElementById("history");
            var children = div1.children;  // -> get all child nodes of div1     
            var len = children.length;
            
            for (let i=0; i<len; i++) {
                
                children[0].remove(); 
            }    

        

            var div3 =  document.getElementById("send");
            var children = div3.children;  
            var len = children.length;
        
            for (let i=0; i<len; i++) {
                
                children[0].remove(); 
            }    
           
        }

        function sendText(username, id){
            // sort by alphabetical order the concatenation of names
            
            chatHistory = document.getElementById("history");
            fullText = document.getElementsByClassName("message");
            text = fullText[0].value;
            text = text.trim(" ");
            console.log(text);
            if(text === ""){
                alert("Please enter a message!")
            }else{
            var para = document.createElement("p");
            // split the two and concatenate Sender:Message
            para.className = "text-end";
            var node = document.createTextNode(text);
            para.appendChild(node);
            chatHistory.appendChild(para);
            message = text;
            namesUser = [];
            namesUser.push(username);
            namesUser.push(id);
            namesUser.sort();
            users = namesUser[0] + namesUser[1];
            sender = username;
            // console.log(users,message,sender)
            ajaxCall(users, message, sender);
            // console.log(id);
            chatting = document.getElementsByClassName("chatting");
            // console.log(chatting)
            for(let i = 0; i<chatting.length;i++){
                // console.log(chatting[i])
                if(chatting[i].name=== id){
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
            
        function ajaxCall(users, message, sender) {
            var usersjs = users;
            var messagejs = message;
            var senderjs = sender;
            // console.log(usersjs, messagejs, senderjs)
            $.ajax({
            type: 'POST',
            url: 'chatDAO.php',
            dataType: "json",
            data: {
            users: usersjs,
            message: messagejs,
            sender: senderjs
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
    
    <script src = "./sean2/home.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>
</body>
</html>