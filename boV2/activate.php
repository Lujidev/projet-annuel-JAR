<?php

require "lib.php";


$db = dbConnect();
$query = $db->prepare("SELECT * FROM UTILISATEURS WHERE activation=:token");
$query->execute( [
    "token"=>$_GET['token']
] );

$res = $query->fetch();

if (!empty($res)){

    $query = $db->prepare("UPDATE UTILISATEURS SET activation=:activation WHERE id_utilisateur=:id");
    $query->execute( [
        "id"=>$res['id_utilisateur'],
        "activation"=> '1'
    ] );
}else{
    echo "Erreur, compte innexistant";
}


?>