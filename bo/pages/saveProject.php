<?php
	require "conf.inc.php";
	require "lib.php";

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
			if (isset($_POST["from"]) && $_POST["from"] == "creerProjet"){

				if (!verifyPresent("PROJETS", "nom_projet", $nom_projet)){

					//Si on vient de la page creerProjet, alors la requête préparée est une insertion
					$query = $db->prepare("INSERT INTO PROJETS (nom_projet, description_projet, categorie_projet) VALUES(:nom_projet, :description_projet, :categorie_projet)");
					
					//Récupération des catégories selectionnées par l'utilisateur
					$categories = getSelectedCategories ($_POST, "p");

					$dataToInsert = [
						        'nom_projet' => $nom_projet, 
						"description_projet" => $description_projet, 
						  "categorie_projet" => $categories
					];

				}
				else{// Le nom est déjà dans la bdd
					$listOfError[] = 2;
					header("location: creerProjet.php?errors=".implode(',', $listOfError));
				}
			}
			//=====================================================================//
			elseif (isset($_POST["from"]) && $_POST["from"] == "modifierProjet") {
				echo "coucou";
			}
			//=====================================================================//

			$query->execute($dataToInsert);
			//echo ("<br><br>DONNES INSEREE !"); // mettre une redirection réelle des que la page est prête; 
			header("location: gererProjet.php");
			
		}
		//=====================================================================//
		else{//($error == true)
			header("location: creerProjet.php?errors=".implode(',', $listOfError));
		}
	} 
	//=====================================================================//
	else{//($_POST est incorrect)
		header("location: tricheur.php");
	}