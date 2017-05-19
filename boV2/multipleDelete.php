<?php

include "lib.php";
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
			header('Location: manageProject.php');
		}elseif (isset($_POST['CATEGORIES'])) {
			header('Location: manageCategorie.php');
		}

		
	}






}



?>