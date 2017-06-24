<?php
session_start();
require "lib.php";
isConnected();


if( !empty($_POST['pseudo']) &&
    !empty($_POST['email']) &&
    !empty($_POST['pwd']) &&
    !empty($_POST['pwd2']) &&
    !empty($_POST['g-recaptcha-response'])
){

    $error = false;
    $listOfError = array();

    // Ma clé privée
    $secret = "6LePgyIUAAAAAFvuHClDVwhgXZ3B7RBxkn29xLod";
    // Paramètre renvoyé par le recaptcha
    $response = $_POST['g-recaptcha-response'];
    // On récupère l'IP de l'utilisateur
    $remoteip = $_SERVER['REMOTE_ADDR'];

    $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
        . $secret
        . "&response=" . $response
        . "&remoteip=" . $remoteip ;

    $decode = json_decode(file_get_contents($api_url), true);

    if ($decode['success'] == true) {

        $pseudo = trim($_POST["pseudo"]);
        if (strlen($pseudo) > 50 || strlen($pseudo) < 3 ){
            $error = true;
            $listOfError[] = 8;
        }

        $email = trim($_POST["email"]);
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error = true;
            $listOfError[]=7;
        }

        if(strlen($_POST['pwd']) < 8 ||
            strlen($_POST['pwd']) > 16 ||
            $pseudo == $_POST['pwd'] ||
            empty($_POST['pwd'])
        ){
            $error = true;
            $listOfError[]=9;
        }

        //pwd2 : identique à pwd
        if($_POST['pwd'] != $_POST['pwd2'] || empty($_POST['pwd2'])){
            $error = true;
            $listOfError[]=10;
        }
        /*
                if($_POST['captcha'] != implode("", $_SESSION['captcha'])){
                    $error = true;
                    $listOfError[]=11;
                }*/

        $presentation = trim($_POST["presentation"]);
        //=====================================================================//
        if (!$error){
            $db = dbConnect();

            //=====================================================================//
            if (!isset($_GET["id"])){

                if (!verifyPresent("UTILISATEURS", "pseudo", $pseudo)){

                    $myImage = uploadImage($_FILES["image"], "user");

                    //Si on vient de la page creerUtilisateur, alors la requête préparée est une insertion
                    $query = $db->prepare("INSERT INTO UTILISATEURS (pseudo, email, avatar, mdp, presentation, droit, activation) VALUES(:pseudo, :email, :avatar, :pwd, :pres, :droit, :activation)");

                    //Récupération des catégories selectionnées par l'utilisateur
                    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

                    $activationKey = md5(uniqid().time()."sjdfhjdgfjqsdkjgshjvhfv");

                    $dataToInsert = [
                        "pseudo" => $pseudo,
                        "email" => $email,
                        "avatar"=> $myImage,
                        "pwd" => $pwd,
                        "pres" => $presentation,
                        "droit" => 2,
                        "activation"=> $activationKey
                    ];

                    sendConfirmationMail($email,$activationKey);

                }
                else{// Le nom est déjà dans la bdd
                    $listOfError[] = 2;
                    header("location: createUser.php?errors=".implode(',', $listOfError));
                }
            }
            //=====================================================================//
            elseif (isset($_GET["id"])) {

                $myImage = uploadImage($_FILES["image"], "user");

                $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

                $query = $db->prepare(
                    "
				UPDATE UTILISATEURS SET
					pseudo = :pseudo,
					email = :email,
					avatar = :avatar,
					presentation = :pres
					WHERE id_utilisateur = :id_utilisateur
				");
                $dataToInsert = [
                    "pseudo" => $pseudo,
                    "email" => $email,
                    "avatar"=> $myImage,
                    "pres" => $presentation,
                    "id_utilisateur" => $_GET["id"]
                ];
            }
            //=====================================================================//
            $query->execute($dataToInsert);
            header("location: manageUser.php");
        }
        //=====================================================================//
        else{//($error == true)
            header("location: createUser.php?errors=".implode(',', $listOfError));
        }
    }
    //=====================================================================//
    else{//($_POST est incorrect)
        header("location: tricheur.php");
    }
}
//=====================================================================//
else {
    header("location: tricheur.php");
}
