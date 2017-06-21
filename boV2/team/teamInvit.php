<?php

require "../lib.php";

if ($_POST["action"] == "accept"){

    $db = dbConnect();
    $query = $db->prepare("SELECT id_team_link FROM TEAMMATES WHERE is_accepted=:token");
    $query->execute( [
        "token"=>$_POST['token']
    ]);

    $res = $query->fetch();

    if (!empty($res)){

        $query = $db->prepare("UPDATE TEAMMATES SET is_accepted=:is_accepted WHERE id_team_link=:id_team_link");
        $query->execute( [
            "id_team_link"=>$res['id_team_link'],
            "is_accepted"=> '1'
        ] );
    }else{
        echo "Erreur, invitation innexistante";
    }

} else if($_POST["action"] == "decline"){

    $db = dbConnect();
    $query = $db->prepare("SELECT id_team_link FROM TEAMMATES WHERE is_accepted=:token");
    $query->execute( [
        "token"=>$_POST['token']
    ]);

    $res = $query->fetch();

    if (!empty($res)){

        $query = $db->prepare("DELETE FROM TEAMMATES WHERE id_team_link=:id_team_link");
        $query->execute( [
            "id_team_link"=>$res['id_team_link']
        ] );
    }else{
        echo "Erreur, invitation innexistante";
    }

}


?>