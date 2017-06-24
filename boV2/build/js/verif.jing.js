function newXMLHttpRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXobject("Microsoft.XMLHTTP");
    }
}


function redError(balise, error) {
    if(error)
        balise.style.backgroundColor = "#fba";
    else
        balise.style.backgroundColor = "";
}

function checkTodo(id){

    var balise = document.getElementById(id);

    if(balise.value.length < 4 || balise.value.length > 15) {
        redError(balise, true);
        var div = document.getElementById("todoError").innerHTML = "Il faut plus décrir la tâche";
        return false;
    }

    else {
        redError(balise, false);
        var div = document.getElementById("todoError").innerHTML = "";
        return true;
    }
}

function checkPseudo(id){

    var request = newXMLHttpRequest();
    var champ = document.getElementById(id);
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.getElementById("validPseudo").innerHTML = request.responseText;
            if(request.responseText == "Destinataire non trouvé"){
                redError(champ, true);
                //return false;
            }
        }
    };
    request.open("POST", "../../checkForm/checkPseudo.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("pseudo="+champ.value);

    if(champ.value.length < 2 || champ.value.length > 25)
    {
        redError(champ, true);
        //return false;
    }

    else
    {
        redError(champ, false);
        //return true;
    }
}


