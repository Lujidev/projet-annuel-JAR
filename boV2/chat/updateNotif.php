<?php
require "../lib.php";
require "chatLib.php";

$db = dbConnect();

$query2 = $db->prepare(
    "SELECT id_team FROM TEAMMATES WHERE id_user = :id_user"
);

$query2->execute([
    "id_user"=>$_POST['userId']
]);

$teams = $query2->fetchAll(PDO::FETCH_ASSOC);

$data=[];

foreach ($teams as $value){

    $query = $db->prepare(
        "SELECT COUNT(*) FROM CHAT WHERE id_team = :id_team"
    );

    $query->execute([
        "id_team"=>$value["id_team"]
    ]);

    $res = $query->fetch(PDO::FETCH_ASSOC);

    $new_nb = $res['COUNT(*)'];

    $query1 = $db->prepare(
        "SELECT id_chat_notif FROM CHATNOTIF WHERE id_user = :id_user AND id_team = :id_team"
    );

    $query1->execute([
        "id_user"=>$_POST['userId'],
        "id_team"=>$value["id_team"]
    ]);

    $testExist = $query1->fetch(PDO::FETCH_ASSOC);

    if (!empty($testExist)){

        $queryUpdate = $db->prepare(
            "UPDATE CHATNOTIF SET new_nb = :new_nb WHERE id_user = :id_user AND id_team = :id_team"
        );

        $queryUpdate->execute([
            "new_nb"=>$new_nb,
            "id_user"=>$_POST['userId'],
            "id_team"=>$value["id_team"]
        ]);


    }else{

        $queryInsert = $db->prepare(
            "INSERT INTO CHATNOTIF(id_user, id_team, new_nb) VALUES(:id_user, :id_team, :new_nb)"
        );

        $queryInsert->execute([
            "new_nb"=>$new_nb,
            "id_user"=>$_POST['userId'],
            "id_team"=>$value["id_team"]
        ]);

    }

    $nb_notif = getNbNotif($_POST['userId'],$value["id_team"]);

    $subData =[
        "teamId" =>$value["id_team"],
        "userId"=>$_POST['userId'],
        "counter"=>$nb_notif
    ];

    array_push($data, $subData);

}

echo json_encode($data);