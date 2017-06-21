<?php
require "../lib.php";
require "libTeam.php";

$search = $_REQUEST["search"];
$teamId = $_REQUEST["teamId"];
$data=[];
$subData=[];


$res = getAllUsers();


if ($search !== "") {
    $search = strtolower($search);
    $length=strlen($search);

    foreach($res as $value) {
        $id = $value["id_utilisateur"];
        $name = $value["pseudo"];

        if (stristr($search, substr($name, 0, $length))) {
            $subData=[
                "id"=>$id,
                "name"=>$name
            ];
            array_push($data, $subData);
        }
    }
}

echo json_encode($data);

?>