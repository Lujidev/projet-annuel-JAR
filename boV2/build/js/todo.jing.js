function hello(){
    //console.log("hello");
    console.log(document.getElementById("finishedTodo").childNodes);
}

function newXMLHttpRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXobject("Microsoft.XMLHTTP");
    }
}

function addTodo(team, check){

    if(check != false){
        var request = newXMLHttpRequest();

        var todo = document.getElementById("todo").value;

        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.getElementById("todo").value = "";
                var list = document.getElementById("todoList");
                var data = JSON.parse(request.responseText);
                var balise = document.createElement("li");
                balise.title = data.id;
                balise.onclick = function(){
                    finishTodo(data.id);
                };
                balise.id = "todo_" + data.id;
                balise.innerHTML = data.value;
                list.appendChild(balise);
                updateProgress(team);
            }
        };

        request.open("POST", "todo/addTodo.php", true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("team="+team+"&todo="+todo);
    }


}

function finishTodo(id){
    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            updateProgressWithId(id);
            var team = document.getElementById("mainContent").title;
            var baliseLi = document.getElementById("todo_"+id);
            baliseLi.parentNode.removeChild(baliseLi);
            var baliseDone = document.createElement("li");
            baliseDone.innerHTML = request.responseText;
            baliseDone.id = "todo_" + id;
            baliseDone.onclick = function(){
                removeTodo(id, team);
            };
            var listDone = document.getElementById("finishedTodo");
            listDone.appendChild(baliseDone);

        }
    };

    request.open("POST", "todo/finishTodo.php", false);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("id="+id);
}

function removeTodo(id, team){

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var baliseLi = document.getElementById("todo_"+id);
            baliseLi.parentNode.removeChild(baliseLi);
            updateProgress(team);
            /*if (document.getElementById("finishedTodo").childNodes){
                document.getElementById("finishedTodo").innerHTML = "Allez, du nerf, commencez votre projet =)";
            }*/
        }
    };

    request.open("POST", "todo/removeTodo.php", false);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("id="+id);

}

function updateProgress(team){

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(JSON.parse(request.responseText));
            var data = JSON.parse(request.responseText);
            var bar = document.getElementById("bar");
            bar.style.width = data+"%";
        }
    };


    request.open("POST", "todo/updateProgress.php", false);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("team="+team);

}

function updateProgressWithId(id){

    var request = newXMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            console.log(data);
            var bar = document.getElementById("bar");
            bar.style.width = data +"%";
        }
    };

    request.open("POST", "todo/updateProgressWithId.php", false);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("id="+id);

}