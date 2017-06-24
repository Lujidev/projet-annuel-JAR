<?php

function countAllUsers(){

    $db = dbConnect();

    $query = $db->prepare(
        "SELECT COUNT(*) as nb_user FROM UTILISATEURS"
    );

    $query->execute([
    ]);

    $res = $query->fetch(PDO::FETCH_ASSOC);

    return $res['nb_user'];
}

function weeklyUpdateMembers(){

    $db = dbConnect();

    $query = $db->prepare(
        "SELECT COUNT(*) as nb_user FROM UTILISATEURS WHERE date_creation > :date_creation"
    );

    $query->execute([
        "date_creation"=>date("Y-m-d G:i:s", strtotime("-1 week"))
    ]);

    $res = $query->fetch(PDO::FETCH_ASSOC);

    return $res['nb_user'];


    /*
        $db = dbConnect();

        $query = $db->prepare(
            "SELECT date_creation FROM UTILISATEURS WHERE id_utilisateur =:id"
        );

        $query->execute([
            "id"=>1
        ]);

        $res = $query->fetch(PDO::FETCH_ASSOC);

        $res2 = strtotime("-1 week");

        return date("Y-m-d G:i:s",$res2);*/

}


?>