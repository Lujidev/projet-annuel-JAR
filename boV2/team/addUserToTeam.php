<?php
require "../lib.php";

$arrayId = explode(",", $_POST['str']);
$teamId = $_POST['teamId'];

foreach ($arrayId as $value){

    $db = dbConnect();
    $token = createToken();

    $query = $db->prepare("INSERT INTO TEAMMATES (id_team, id_user, is_accepted) VALUES(:id_team, :id_user, :is_accepted)");
    $query->execute([
        "id_team"=>$teamId,
        "id_user"=>$value,
        "is_accepted"=>$token
    ]);

    $query1 = $db->prepare("SELECT nom_equipe FROM EQUIPES WHERE id=:id");
    $query1->execute([
        "id"=>$teamId
    ]);

    $res = $query1->fetch();

    $link = "http://localhost/projet-annuel-JAR/boV2/joinTeam.php?token=".$token;
    $preview = "upload/assets/defaultInvitation.png";
    $content = $res['nom_equipe']." vous invite à les rejoindre.";

    addNotif($preview, "Team_Invitation", $content, $value, $link);

}


?>