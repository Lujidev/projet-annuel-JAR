<?php
require "../lib.php";
require "chatLib.php";

$teamId = $_GET['teamId'];

$db = dbConnect();

$query = $db->prepare(
    "SELECT * FROM CHAT WHERE id_team = :id_team ORDER BY send_time"
);

$query->execute([
    "id_team"=>$teamId
]);

$res = $query->fetchAll(PDO::FETCH_ASSOC);


$data = [];

foreach ($res as $value){

    $query1 = $db->prepare(
        "SELECT * FROM UTILISATEURS WHERE id_utilisateur = :id_utilisateur"
    );

    $query1->execute([
        "id_utilisateur"=>$value['id_user']
    ]);

    $user = $query1->fetch(PDO::FETCH_ASSOC);

    $value['img'] = $user['avatar'];
    array_push($data, $value);
}

echo json_encode($data);

?>