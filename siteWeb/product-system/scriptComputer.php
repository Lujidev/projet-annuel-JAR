<?php

include "../headerWeb.php";

if (isset($_POST['name'])&&
    isset($_POST['cpu'])&&
    isset($_POST['gpu'])&&
    isset($_POST['ram'])&&
    isset($_POST['brand'])
) {


    $db = dbConnect();

    $param = [
        $_POST['name'],
        $_POST['cpu'],
        $_POST['gpu'],
        $_POST['ram'],
        $_POST['brand'],
    ];

    $query = $db->prepare('INSERT INTO COMPUTER (name_pc, cpu, gpu, ram, brand) VALUES (?, ?, ?, ?, ?)');
    $query->execute($param);
    http_response_code(200);

}else {
    http_response_code('400');
}
