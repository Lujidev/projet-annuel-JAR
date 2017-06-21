<?php
require "../lib.php";
require "libTeam.php";

$db = dbConnect();

$userId = $_GET["userId"];
$teamId = $_GET["teamId"];

$query = $db->prepare("SELECT id_user FROM TEAMMATES WHERE id_team = :id_team AND id_user = :id_user");

$query->execute([
    "id_team"=>$teamId,
    "id_user"=>$userId
]);

$res = $query->fetch();


if (empty($res)) {

    $query = $db->prepare("SELECT avatar FROM UTILISATEURS WHERE id_utilisateur = :id_user");

    $query->execute([
        "id_user"=>$userId
    ]);

    $res = $query->fetch();

    echo $res['avatar'];

}else {
    echo "";
}




?>