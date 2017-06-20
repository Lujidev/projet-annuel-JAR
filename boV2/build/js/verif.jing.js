function redError(balise, error) {
    if(error)
        balise.style.backgroundColor = "#fba";
    else
        balise.style.backgroundColor = "";
}

function checkTodo(id){

    var balise = document.getElementById(id);

    if(balise.value.length < 4 || balise.value.length > 15) {
        redHighlight(balise, true);
        var div = document.getElementById("todoError").innerHTML = "Il faut plus décrir la tâche";
        return false;
    }

    else {
        redHighlight(balise, false);
        var div = document.getElementById("todoError").innerHTML = "";
        return true;
    }



}
