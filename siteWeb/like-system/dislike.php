<?php
require "../headerWeb.php";

$id = $_GET["id"];

$db = dbConnect();

$query = $db->prepare("INSERT INTO DISLIKES (id_article, id_user) VALUES (?, ?)");
$query->execute([
    $id,
    $user["id_utilisateur"]
]);
$res = $query->fetch();






