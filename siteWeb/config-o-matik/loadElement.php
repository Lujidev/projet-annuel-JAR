<?php

/*Include lib.php au propre après*/
define("DB_DRIVER", "mysql");
define("DB_NAME", "projetannuel");
define("DB_HOST", "localhost");
define("DB_PORT", 3306);
define("DB_USER", "root");
define("DB_PWD", "root");

function dbConnect(){
    try{
        $db = new PDO(
            DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
    }
    catch(Exception $e){
        die ("Erreur SQL ".$e->getMessage());
    }
    return $db;
}



if ( isset($_GET["elem"]) && isset($_GET["filter"])){

    $stmt = dbConnect()->prepare("SELECT * FROM composants WHERE comp_type=? AND filtre=?");
    $stmt->execute( [ $_GET["elem"], $_GET["filter"] ] );
    $comp = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($comp);
    http_response_code(200);
}else{
    http_response_code(400);    
}
