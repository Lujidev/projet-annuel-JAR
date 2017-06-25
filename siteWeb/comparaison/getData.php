<?php
require "../lib.php";


$pcId = $_GET['id'];

$db = dbConnect();
$query = $db->prepare("SELECT * FROM COMPUTER WHERE id_pc = :id_pc");
$query->execute([
    "id_pc"=>$pcId
]);

$res = $query->fetchAll(PDO::FETCH_ASSOC);
/*
$column = [
    "column"=>$_GET["column"]
];*/
//array_push($res, $column);

//print_r($res);

$res['column'] = $_GET["column"];

echo json_encode($res);



?>