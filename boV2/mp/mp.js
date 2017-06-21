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
function getMP(id, id_user) {

    var request = newXMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.getElementById("text").innerHTML = request.responseText;
        }
    };
    request.open("POST", "mp/getMpData.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("is_read_mp=1&id_mp="+id+"&id_user="+id_user);
}

function sendMp(user) {

    var balise_id = "'"+"name"+"'";

    document.getElementById("text").innerHTML = '<form role="form" method="POST" action="mp/saveMp.php" enctype="multipart/form-data" class="form-horizontal form-label-left" onsubmit="verifPseudo('+ balise_id +')" >' +
        '<div class="item form-group">' +
        '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Destinataire<span class="required">*</span></label>' +
        '<div class="col-md-6 col-sm-6 col-xs-12">' +
        '<input id="name" class="form-control col-md-7 col-xs-12" name="destinataire_mp" placeholder="Plus de 2 lettres" required="required" type="text" oninput="verifPseudo('+ balise_id +')" >' +
        '</div>' +
        '<p id="validPseudo"></p>' +
        '</div>' +
        '<div class="item form-group">' +
        '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sujet<span class="required">*</span></label>' +
        '<div class="col-md-6 col-sm-6 col-xs-12">' +
        '<input id="mp_subject" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="sujet" placeholder="Plus de 2 lettres" type="text" required>' +
        '</div>' +
        '</div>' +
        '<div class="item form-group">' +
        '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Contenu du Message <span class="required">*</span></label>' +
        '<div class="col-md-6 col-sm-6 col-xs-12">' +
        '<textarea id="mp_content" required="required" name="contenu_mp" class="form-control col-md-7 col-xs-12" rows="10" required></textarea>' +
        '</div>' +
        '</div>' +
        '<div class="col-md-6 col-md-offset-3">' +
        '<button type="submit" class="btn btn-success">Envoyer</button>' +
        '</div>' +
        '<input type="hidden" name="sender" value="'+ user +'">' +
        '</form>';
}

function verifPseudo(id) {
    var request = newXMLHttpRequest();
    var champ = document.getElementById(id);
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var msg = JSON.parse(request.responseText);
            document.getElementById("validPseudo").innerHTML = msg;
            if(msg == "Destinataire non trouvé"){
                redHighlight(champ, true);
                //return false;
            }
        }
    };
    request.open("POST", "mp/saveMp.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("jsVerif=1&pseudo="+champ.value);

    if(champ.value.length < 2 || champ.value.length > 25) {
        redHighlight(champ, true);
        //return false;
    }else{
        redHighlight(champ, false);
        //return true;
    }
}

function redHighlight(champ, error)
{
    if(error)
        champ.style.backgroundColor = "#fba";
    else
        champ.style.backgroundColor = "";
}

function anwser(id_sender, id_reciver, id_msg, bolean){

    document.getElementById("text").innerHTML = 'sender:'+id_sender+'reciver:'+id_reciver+'msg:'+id_msg+'lafin';

    var request = newXMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
           sendMp(id_sender);
           if(bolean == true){
               document.getElementById("name").value = data.receiver;
               document.getElementById("mp_subject").value = "RE: "+data.subject;
           }else{
               document.getElementById("mp_subject").value = "Transfer: "+data.subject;
           }
           document.getElementById("mp_content").value = "\n\n\n\n\n\n\n Message Précédent \n ----------------------------\n"+data.content;
        }
    };
    request.open("POST", "mp/anwserMpData.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("id_mp="+id_msg+"&id_sender="+id_sender);

}

function printMsg(){
    var mailBox = document.getElementById("mail_container");
    window.print();
}

