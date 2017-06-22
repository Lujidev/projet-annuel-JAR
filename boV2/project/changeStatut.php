<?php
require "../lib.php";

$db = dbConnect();

$query = $db->prepare("SELECT project_statut FROM PROJETS WHERE id_projet = :id");
$query->execute([
    "id"=>$_POST['id'],
]);

$res = $query->fetch();

if ($res["project_statut"] != 1){

    $query1 = $db->prepare("UPDATE PROJETS SET project_statut = :statut WHERE id_projet = :id");
    $query1->execute([
        "id"=>$_POST['id'],
        "statut"=>1
    ]);

    echo "1";
}else{
    $query1 = $db->prepare("UPDATE PROJETS SET project_statut = :statut WHERE id_projet = :id");
    $query1->execute([
        "id"=>$_POST['id'],
        "statut"=>0
    ]);
    echo "0";
}


?>