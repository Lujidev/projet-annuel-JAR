function hello(){
   alert("hello");
}


var memoryTeamId = "";
var memoryUserId = "";

function updateMemory(teamId, userId){
    memoryTeamId = teamId;
    memoryUserId = userId;
}

function newXMLHttpRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXobject("Microsoft.XMLHTTP");
    }
}


function sendChatMsg(userId, teamId){

    var typingBox = document.getElementById("typingBox");
    var msg = typingBox.value;

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(request.responseText);
        }
    };

    typingBox.value = "";
    request.open("POST", "chat/saveChatMsg.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("userId="+userId+"&teamId="+teamId+"&content="+msg);

}


function openChatBox(teamId, userId, teamName){

    updateMemory(teamId, userId);

    var request = newXMLHttpRequest();
    var chatBox = document.getElementById("chatBox");
    chatBox.innerHTML = "";

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("teamName").innerHTML = teamName;

            document.getElementById("sendButton").onclick = function(){
                sendChatMsg(userId, teamId);
            };
            var data = JSON.parse(request.responseText);
            console.log(data);
            var msg ="";
            for (var i = 0; i<data.length; i++){
                msg = data[i];
                if (msg.id_user == userId){
                    var baliseLi = document.createElement("li");
                    baliseLi.setAttribute("class", "right clearfix admin_chat");
                    var span = document.createElement("span");
                    span.setAttribute("class", "chat-img1 pull-right");
                    var img = document.createElement("img");
                    img.src = "upload/user/"+msg.img;
                    img.setAttribute("class", "img-circle");
                    var div = document.createElement("div");
                    div.setAttribute("class", "chat-body1 clearfix");
                    var p = document.createElement("p");
                    p.innerHTML = msg.msg_content;
                    var timeDiv = document.createElement("div");
                    timeDiv.setAttribute("class", "chat_time pull-left");
                    timeDiv.innerHTML = msg.send_time;
                    chatBox.appendChild(baliseLi);
                    baliseLi.appendChild(span);
                    span.appendChild(img);
                    baliseLi.appendChild(div);
                    div.appendChild(p);
                    div.appendChild(timeDiv);
                }else{
                    var baliseLi = document.createElement("li");
                    baliseLi.setAttribute("class", "right clearfix");
                    var span = document.createElement("span");
                    span.setAttribute("class", "chat-img1 pull-left");
                    var img = document.createElement("img");
                    img.src = "upload/user/"+msg.img;
                    img.setAttribute("class", "img-circle");
                    var div = document.createElement("div");
                    div.setAttribute("class", "chat-body1 clearfix");
                    var p = document.createElement("p");
                    p.innerHTML = msg.msg_content;
                    var timeDiv = document.createElement("div");
                    timeDiv.setAttribute("class", "chat_time pull-right");
                    timeDiv.innerHTML = msg.send_time;
                    chatBox.appendChild(baliseLi);
                    baliseLi.appendChild(span);
                    span.appendChild(img);
                    baliseLi.appendChild(div);
                    div.appendChild(p);
                    div.appendChild(timeDiv);
                }
            }
            scrollBar();
        }
    };

    request.open("GET", "chat/openChat.php?teamId="+teamId, true);
    request.send();
}

function updateChatBoxMsg(memoryTeamId, memoryUserId){

    var request = newXMLHttpRequest();
    chatBox.innerHTML = "";
    request.onreadystatechange = function() {
        if (request.readyState == 4 && (request.status == 200 || request.status == 0)) {
            var data = JSON.parse(request.responseText);
            var msg ="";
            for (var i = 0; i<data.length; i++){
                msg = data[i];
                if (msg.id_user == memoryUserId){
                    var baliseLi = document.createElement("li");
                    baliseLi.setAttribute("class", "right clearfix admin_chat");
                    var span = document.createElement("span");
                    span.setAttribute("class", "chat-img1 pull-right");
                    var img = document.createElement("img");
                    img.src = "upload/user/"+msg.img;
                    img.setAttribute("class", "img-circle");
                    var div = document.createElement("div");
                    div.setAttribute("class", "chat-body1 clearfix");
                    var p = document.createElement("p");
                    p.innerHTML = msg.msg_content;
                    var timeDiv = document.createElement("div");
                    timeDiv.setAttribute("class", "chat_time pull-left");
                    timeDiv.innerHTML = msg.send_time;
                    chatBox.appendChild(baliseLi);
                    baliseLi.appendChild(span);
                    span.appendChild(img);
                    baliseLi.appendChild(div);
                    div.appendChild(p);
                    div.appendChild(timeDiv);
                }else{
                    var baliseLi = document.createElement("li");
                    baliseLi.setAttribute("class", "right clearfix");
                    var span = document.createElement("span");
                    span.setAttribute("class", "chat-img1 pull-left");
                    var img = document.createElement("img");
                    img.src = "upload/user/"+msg.img;
                    img.setAttribute("class", "img-circle");
                    var div = document.createElement("div");
                    div.setAttribute("class", "chat-body1 clearfix");
                    var p = document.createElement("p");
                    p.innerHTML = msg.msg_content;
                    var timeDiv = document.createElement("div");
                    timeDiv.setAttribute("class", "chat_time pull-right");
                    timeDiv.innerHTML = msg.send_time;
                    chatBox.appendChild(baliseLi);
                    baliseLi.appendChild(span);
                    span.appendChild(img);
                    baliseLi.appendChild(div);
                    div.appendChild(p);
                    div.appendChild(timeDiv);
                }
            }
            scrollBar();
        }
    };
    request.open("GET", "chat/openChat.php?teamId="+memoryTeamId, true);
    request.send(null);
}

function scrollBar(){
    var elem = document.getElementById('msgWindow');
    elem.scrollTop = elem.scrollHeight;
}

function updateNotif(userId){

    memoryUserId = userId;

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(request.responseText);
            var data = JSON.parse(request.responseText);
            console.log(data);
            var notif= "";

            for (var i =0; i<data.length; i++){
                notif = data[i];
                if (notif.counter == 0){
                    document.getElementById("notif_"+notif.teamId).innerHTML = "";

                }else {
                    document.getElementById("notif_"+notif.teamId).innerHTML = notif.counter;
                }

            }
        }
    };


    request.open("POST", "chat/updateNotif.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("userId="+userId);

}

function checkedNotif(teamId, userId){

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(request.responseText);
        }
    };

    request.open("POST", "chat/checkedNotif.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("userId="+userId+"&teamId="+teamId);

}


setInterval(function(){updateChatBoxMsg(memoryTeamId, memoryUserId)}, 3000);
setInterval(function(){updateNotif(memoryUserId)}, 3000);


