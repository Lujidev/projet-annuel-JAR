<?php
session_start();
require "lib.php";
$user = isConnected();

if (!empty($_POST) && isset($_POST["nom_projet"])){

    $error = false;
    $listOfError = array();

    $nom_projet = trim($_POST["nom_projet"]);

    if (strlen($nom_projet) > 50 || strlen($nom_projet) < 3 ){
        $error = true;
        $listOfError[] = 0;
    }

    $description_projet = trim($_POST["description_projet"]);
    if (strlen($description_projet) > 5000 || strlen($description_projet) < 0 ){
        $error = true;
        $listOfError[] = 1;
    }

    //=====================================================================//
    if (!$error){
        $db = dbConnect();

        //=====================================================================//
        if (!isset($_GET["id"])){

            if (!verifyPresent("PROJETS", "nom_projet", $nom_projet)){
                $id_team = $_POST['id_team'];

                $myImage = uploadImage($_FILES["image"], "project");

                //Si on vient de la page creerProjet, alors la requête préparée est une insertion
                $query = $db->prepare("INSERT INTO PROJETS (nom_projet, description_projet, id_team,categorie_projet, img_projet) VALUES(:nom_projet, :description_projet, :id_team,:categorie_projet, :img_projet)");

                //Récupération des catégories selectionnées par l'utilisateur
                $categories = getSelectedCategories ($_POST, "p");

                $dataToInsert = [
                    'nom_projet' => $nom_projet,
                    "description_projet" => $description_projet,
                    "id_team"=>$id_team,
                    "categorie_projet" => $categories,
                    "img_projet"=>$myImage
                ];

            }
            else{// Le nom est déjà dans la bdd
                $listOfError[] = 2;
                header("location: createProject.php?errors=".implode(',', $listOfError));
            }
        }
        //=====================================================================//
        elseif (isset($_GET["id"])) {

            $myImage = uploadImage($_FILES["image"], "project");

            $query = $db->prepare(
                "
				UPDATE PROJETS SET
					nom_projet=:nom_projet,
					description_projet=:description_projet,
					img_projet=:img_projet
					WHERE id_projet=:id_projet
				");

            $dataToInsert = [
                "nom_projet" => $nom_projet,
                "description_projet" => $description_projet,
                "img_projet"=> $myImage,
                "id_projet" => $_GET["id"]
            ];
        }
        //=====================================================================//

        $query->execute($dataToInsert);
        header("location: listProject.php");
        /*
        echo'
            <script type="text/javascript">
                window.location.href = \'listProject.php\';
            </script>
            ';*/
    }
    //=====================================================================//
    else{//($error == true)
        header("location: createProject.php?errors=".implode(',', $listOfError));
    }
}
//=====================================================================//
else{//($_POST est incorrect)
    header("location: tricheur.php");
}