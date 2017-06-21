function hello(){

    console.log("hello");
    document.getElementById("tags_1").value += ", bonjour";

}

function newXMLHttpRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXobject("Microsoft.XMLHTTP");
    }
}

function showSuggest(teamId){

    var search = document.getElementById('search').value;

    if (search.length == 0) {
        document.getElementById("suggest").innerHTML = "";
    } else {
        var request = newXMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var suggestBox = document.getElementById("suggest");
                var suggest =  JSON.parse(request.responseText);
                var name = "";
                var userId="";
                suggestBox.innerHTML = "";
                for(var i="0"; i<suggest.length; i++) {
                    userId = suggest[i].id;
                   name = suggest[i].name;
                   var input = document.createElement("input");
                   input.value = name;
                   input.type = "button";
                   input.onclick = function(){
                       addName(userId, teamId, name);
                   };
                   suggestBox.appendChild(input);
                }
            }
        };

        request.open("GET", "team/getSuggest.php?search=" + search +"&teamId="+teamId, true);
        request.send();
    }

}

function addName(userId, teamId, name){

    var users = document.getElementById("user");

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            if(request.responseText == ""){
                alert("utilisateur déjà dans le groupe");
            }else if(users.innerHTML.indexOf(userId) != -1){
                alert('cet utilisateur est déjà choisi');
            }else{
                var balise = document.createElement("li");
                balise.value = userId;
                var removeId = "preAdd_" + userId;
                balise.id = removeId;
                var img = document.createElement("img");
                img.setAttribute("class", "avatar");
                img.src = "upload/user/" + request.responseText;
                img.onclick = function(){
                    removeName(removeId);
                };
                users.appendChild(balise);
                balise.appendChild(img);
            }
        }
    };
    request.open("GET", "team/checkMember.php?userId=" + userId+"&teamId="+teamId);
    request.send();

}

function removeName(id){
    var baliseLi = document.getElementById(id);
    baliseLi.parentNode.removeChild(baliseLi);
}

function submitAdd(teamId){

    var container = document.getElementById("user");
    var list = container.getElementsByTagName("li");
    console.log(teamId);
    console.log(list);

    var user = [];

    for(i=0; i<list.length; i++){
        user.push(list[i].value);
    }

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("groupDebug").innerHTML = request.responseText;
            //console.log(request.responseText);
            container.innerHTML ='<div class="alert alert-success alert-dismissible fade in" role="alert">' +
                'Invitation(s) Envoyée(s)</div>';
        }
    };

    request.open("POST", "team/addUserToTeam.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("str="+user+"&teamId="+teamId);

}


function acceptInvit(token){

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("groupDebug").innerHTML = request.responseText;
            //console.log(request.responseText);
            window.location = "manageTeam.php";
        }
    };

    request.open("POST", "team/teamInvit.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("token="+token+"&action=accept");

}

function declineInvit(token){

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("groupDebug").innerHTML = request.responseText;
            //console.log(request.responseText);
            window.location = "manageTeam.php";
        }
    };

    request.open("POST", "team/teamInvit.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("token="+token+"&action=decline");

}