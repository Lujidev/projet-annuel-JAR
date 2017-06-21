<?php
require "../lib.php";

$db = dbConnect();

$query = $db->prepare("SELECT * FROM MESSAGESP WHERE id_mp=:id_mp");
$query->execute([
    "id_mp"=>$_GET['id_mp']
]);

$res = $query->fetch();

if ($_GET['id'] == $res['auteur_mp']){

    $query = $db->prepare("UPDATE MESSAGESP SET is_deleted_auteur = '1' WHERE id_mp=:id_mp");
    $query->execute([
        "id_mp"=>$_GET['id_mp']
    ]);


}else{

    $query = $db->prepare("UPDATE MESSAGESP SET is_deleted_destinataire = '1' WHERE id_mp=:id_mp");
    $query->execute([
        "id_mp"=>$_GET['id_mp']
    ]);

}

$query = $db->prepare("SELECT id_mp FROM MESSAGESP WHERE is_deleted_destinataire = '1' AND is_deleted_auteur ='1'");
$query->execute([
]);

$res = $query->fetchAll();


if (!empty($res)){

    foreach ($res as $value){

        $query = $db->prepare("DELETE FROM MESSAGESP WHERE id_mp=:id_mp");

        $query->execute([
            "id_mp"=>$value["id_mp"]
        ]);
    }
}

header("location: ../mp.php");



?>