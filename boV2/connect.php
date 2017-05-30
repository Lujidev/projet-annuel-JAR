<?php
    require "conf.inc.php";
    require "lib.php";

    $msg_error = '';

    /*Vérification si le formulaire a été remplis*/    
    if (isset($_POST["email"]) && isset($_POST["mdp"]))
    {
        //Si la personne est dans la BDD et qu'il y a le bon pwd, la personne sera considérée comme connectée
        $connect = false;

        $db = dbConnect();
        //je récupère mdp hashé dans la bdd pour l'email saisi
        $query = $db->prepare("SELECT id_utilisateur, mdp FROM UTILISATEURS WHERE email=:email AND is_deleted=0 AND activation=1;");
        $query->execute(["email"=>$_POST["email"]]);
        $result = $query->fetch();
        
        if (!empty($result) && password_verify ($_POST["mdp"], $result["mdp"])){
            session_start();
            $accessToken = createToken();
            $_SESSION["access_token"] = $accessToken;
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["id_utilisateur"] = $result["id_utilisateur"];
            
            $query = $db->prepare("UPDATE UTILISATEURS SET access_token=:token WHERE id_utilisateur=:id;");
            $query->execute(["id"=>$result["id_utilisateur"], "token"=>$_SESSION["access_token"]]);
            
            header("location: index.php");
        }
        else{
            $msg_error = "identifiant incorrecte";

            if (!file_exists("log"))
                mkdir ("log");
            $file = fopen ("log/login.txt", "a");
            fwrite ($file, $_POST["email"].":".$_POST["mdp"]."\r\n");
            fclose ($file);
            header("location: login.php");
        }
    }
?>