<?php
session_start();
require "lib.php";
$user = isConnected();

print_r($_POST);


if (!empty($_POST) && isset($_POST["nom_equipe"])){

    $error = false;
    $listOfError = array();

    $nom_equipe = trim($_POST["nom_equipe"]);
    if (strlen($nom_equipe) > 50 || strlen($nom_equipe) < 3 ){
        $error = true;
        $listOfError[] = 3;
    }

    $description_equipe = trim($_POST["description_equipe"]);
    if (strlen($description_equipe) > 250 || strlen($description_equipe) < 0 ){
        $error = true;
        $listOfError[] = 4;
    }

    //=====================================================================//
    if (!$error){
        $db = dbConnect();

        //=====================================================================//
        if (!isset($_GET["id"])){

            if (!verifyPresent("EQUIPES", "nom_equipe", $nom_equipe)){

                //Si on vient de la page creerEquipe, alors la requête préparée est une insertion
                $query = $db->prepare("INSERT INTO EQUIPES (nom_equipe, description_equipe, categorie_equipe, createur) VALUES(:nom_equipe, :description_equipe, :categorie_equipe, :createur)");

                //Récupération des catégories selectionnées par l'utilisateur
                $categories = getSelectedCategories ($_POST, "e");

                $dataToInsert = [
                    "nom_equipe" => $nom_equipe,
                    "description_equipe" => $description_equipe,
                    "categorie_equipe" => $categories,
                    "createur"=>$user['id_utilisateur']
                ];

            }
            else{// Le nom est déjà dans la bdd
                $listOfError[] = 2;
                header("location: createTeam.php?errors=".implode(',', $listOfError));
            }
        }
        //=====================================================================//
        elseif (isset($_GET["id"])) {

            $query = $db->prepare(
                "
				UPDATE EQUIPES SET
					nom_equipe=:nom_equipe,
					description_equipe=:description_equipe
					WHERE id=:id
				");

            $dataToInsert = [
                "nom_equipe" => $nom_equipe,
                "description_equipe" => $description_equipe,
                "id" => $_GET["id"]
            ];
        }
        //=====================================================================//

        $query->execute($dataToInsert);
        createTeamLink($user['id_utilisateur']);
        header("location: manageTeam.php");

    }
    //=====================================================================//
    else{//($error == true)
        header("location: createTeam.php?errors=".implode(',', $listOfError));
    }
}
//=====================================================================//
else{//($_POST est incorrect)
    header("location: tricheur.php");
}
