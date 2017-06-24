<?php
session_start();
include "lib.php";
require "project/libProject.php";
isConnected();

$ids=0;

if(isset($_POST['delete'])){


	if (isset($_POST['UTILISATEURS']) || isset($_POST['ARTICLES'])) {

			$table = key($_POST);
			$idToDelete = $_POST['delete'];
			$colonne = $_POST[$table];

			$db = dbConnect();

		foreach ($idToDelete as $value) {

		    $query = $db->prepare("UPDATE ".$table." SET is_deleted = '1' WHERE ".$colonne."=:ids");
		    $query->execute([
		                "ids" => $value
		            ]);

		}

		if (isset($_POST['UTILISATEURS'])) {
			header('Location: manageUser.php');
		} elseif (isset($_POST['ARTICLES'])) {
			header('Location: manageArticle.php');
		}
		
	}


	if (isset($_POST['EQUIPES']) || isset($_POST['PROJETS']) || isset($_POST['CATEGORIES'])) {

			$table = key($_POST);
			$idToDelete = $_POST['delete'];
			$colonne = $_POST[$table];

			$db = dbConnect();

		foreach ($idToDelete as $value) {

		    $query = $db->prepare("DELETE FROM ".$table." WHERE ".$colonne."=:ids");
		    $query->execute([
		                "ids" => $value
		            ]);

		}
		if (isset($_POST['EQUIPES'])) {
			header('Location: manageTeam.php');
		}elseif (isset($_POST['PROJETS'])) {
			header('Location: listProject.php');
		}elseif (isset($_POST['CATEGORIES'])) {
			header('Location: manageCategory.php');
		}

		
	}

	if (isset($_POST['id_team'])){

        print_r($_POST);
      print_r($_GET);

        $idToDelete = $_POST['delete'];

        $isCreator = isCreatorOfTeam($_POST['id_team'], $_GET['userId']);

        if (!empty($isCreator) || $_GET["userRole"] == 3){

            $db = dbConnect();

            foreach ($idToDelete as $value) {

                $query = $db->prepare("DELETE FROM TEAMMATES WHERE id_team = :id_team AND id_user = :id_user");
                $query->execute([
                    "id_team" => $_POST['id_team'],
                    "id_user"=>$value
                ]);
            }
        }
        header('Location: team.php?id='.$_POST["id_team"]);
    }








}



?>