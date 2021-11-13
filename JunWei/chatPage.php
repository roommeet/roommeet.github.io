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


    <!-- Axios -->
    <!-- <script src="https://unpkg.com/axios/dist/axios.js"></script> -->

</head>
<body>
    <?php
    include_once "common.php";
    
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
    // var_dump($chats);
    // foreach ($chat_history as $item){
    //     $chats["JosephMary"][] = $item->getChat_string();
    //     // echo($chats["JosephMary"]);
    //     // echo ($item->getChat_string().$item->getUsers()."</br>");
    //     // echo ("");
    // };
    // var_dump($chats);
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

    <!-- <div id = "app"> {{ testing }}
        <div class="btn-group-vertical  col-3" role="group" aria-label="Basic radio toggle button group">
            <div v-for="(name,value) in testing">
                <input  type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
            </div>
        </div>  
    </div> -->
    <div class = "container-fluid" id = "app">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </div>
    <div class = "container-fluid">
        <div class = "row">
            
            <div id = "chatList" class="btn-group-vertical  col-3" role="group" aria-label="Basic radio toggle button group">
            </div>
            <div class = "col-9" id = "history">
                
            </div>
        
            
        </div>
        <div class = "row">
            <div class = "col-3"></div>
            <div class = "col-9" id = "send">
        </div>
    </div>


    <!-- Use VUE for search function -->


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
        para.className ="btn btn-info btn-lg"; 

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
                        // para.className = "text-right";
                        var node = document.createTextNode(message[1] + ": " + message[0]);

                        para.appendChild(node);
                        
                        chatHistory.appendChild(para);
                    }
                }
            }
            var chatBox = document.createElement("input");
            chatBox.name = "message"
            chatBox.type = "text";
            chatBox.className = "message"
            chatBox.placeholder = "Message";
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
            button.className ="btn btn-info"; 
            sending.appendChild(button);



            var username = document.getElementById("identifier").name;
            sending.addEventListener("keypress", function(e){
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

            
            // console.log(chatBox);
            // console.log(id, username);

        //     var para = document.createElement("input");
        //     para.type = "button";
        // // set id attribute 
        //     para.id = key
        //     para.value = key;
        //     para.name = key;
        //     para.className ="btn btn-info btn-lg"; 

            // var element = document.getElementById("chatList");
            // element.appendChild(para);

        }

        function hideHistory(id){
            var div1 =  document.getElementById("history");
            var children = div1.children;  // -> get all child nodes of div1     
            var len = children.length;
            // console.log(div1);
            // console.log(id)
            // chatting = document.getElementsByClassName("chatting");
            // for (let i =0; i<chatting.length; i++){
            //     if(chatting[i].name == id){
            //         chatting[i]
            //     }
            // }
            // console.log(document.getElementsByClassName("chatting").length)
            for (let i=0; i<len; i++) {
                // console.log(children[0]);
                // can't use the index, children[i], since the children array is 
                // affected as the element is removed      
                // console.log(children[0].innerHTML)

                // if(i!== 0){
            
                // }
                // console.log(document.getElementsByClassName("chatting")[0]);
                children[0].remove(); 
            }    

            var div2 =  document.getElementById("send");
            var children = div2.children;  
            var len = children.length;
            // console.log(len);
            for (let i=0; i<len; i++) {
                // console.log(children[0]);
                // can't use the index, children[i], since the children array is 
                // affected as the element is removed      
                children[0].remove(); 
            }    
            //document.getElementById("div1").innerHTML = ""
        }

        function sendText(username, id){
            // sort by alphabetical order the concatenation of names
            
            chatHistory = document.getElementById("history");
            fullText = document.getElementsByClassName("message");
            text = fullText[0].value;
            // console.log(text);
            if(text === ""){
                alert("Please enter a message!")
            }else{
            var para = document.createElement("p");
            // split the two and concatenate Sender:Message
            // para.className = "text-right";
            var node = document.createTextNode(username + ": " + text);
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
                console.log(chatting[i])
                if(chatting[i].name=== id){
                    // console.log("HI")
                    chatting[i].value += "</br>" + text + "</s>" + username;
                    // chatting_value = chatting[i].value;
                    // chatting_value+="</br>" + text + "</s>" + username;
                    // chatting[i].value = "";
                    // console.log(chatting[i].value)
                }
            }
            fullText[0].value = "";

        }
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
                console.log(response);
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
    
    <script>
    
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>
</body>
</html>