/*function getXMLHttpRequest() {
    var xhr = null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }

    return xhr;
}*/

function newXMLHttpRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXobject("Microsoft.XMLHTTP");
    }
}


/*function getMP(id) {

    request = newXMLHttpRequest();
    request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.getElementById("text").innerHTML = request.responseText;
            }
        };
    request.open("GET","getMpData.php?id_mp="+ id,true);
    request.send();
}*/
function getMP(id) {

    var request = newXMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.getElementById("text").innerHTML = request.responseText;
        }
    };
        request.open("POST", "getMpData.php", true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("is_read_mp=1&id_mp="+id);
}

function sendMp(user) {

    document.getElementById("text").innerHTML = '<form role="form" method="POST" action="saveTeam.php" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>' +
        '<div class="item form-group">' +
        '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sujet<span class="required">*</span></label>' +
        '<div class="col-md-6 col-sm-6 col-xs-12">' +
        '<input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="nom_equipe" placeholder="Plus de 2 lettres" required="required" type="text">' +
        '</div>' +
        '</div>' +
        '</form>'

}