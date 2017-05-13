<?php
	require "conf.inc.php";
	require "lib.php";

	if (!empty($_POST) && isset($_POST["nom_categorie"])){

		$error = false;
		$listOfError = array();

		$nom_categorie = trim($_POST["nom_categorie"]);
		if (strlen($nom_categorie) > 50 || strlen($nom_categorie) < 3 ){
			$error = true;
			$listOfError[] = 3;
		}

		$description_categorie = trim($_POST["description_categorie"]);
		if (strlen($description_categorie) > 250 || strlen($description_categorie) < 0 ){
			$error = true;
			$listOfError[] = 4;
		}

		$listOfFilter = ["a"=>"a", "e"=>"e", "p"=>"p"];
		$filter = trim($_POST["filter"]);
		if (strlen($filter) != 1 ||
			!array_key_exists( $filter, $listOfFilter)){
			$error = true;
		}
		
		//=====================================================================//
		if (!$error){
			$db = dbConnect();
			
			//=====================================================================//
			if (isset($_POST["from"]) && $_POST["from"] == "creerCategorie"){

				if (!verifyPresent("CATEGORIES", "nom_categorie", $nom_categorie)){

					//Si on vient de la page creerCategorie, alors la requête préparée est une insertion
					$query = $db->prepare("INSERT INTO CATEGORIES (nom_categorie, description_categorie, filter) VALUES(:nom_categorie, :description_categorie, :filter)");
					
					$dataToInsert = [
						        "nom_categorie" => $nom_categorie, 
						"description_categorie" => $description_categorie, 
						  			"filter" => $filter
					];

				}
				else{// Le nom est déjà dans la bdd
					$listOfError[] = 2;
					header("location: createCategories.php?errors=".implode(',', $listOfError));
				}
			}
			//=====================================================================//
			elseif (isset($_POST["from"]) && $_POST["from"] == "modifierCategorie") {
				echo "coucou";
			}
			//=====================================================================//

			$query->execute($dataToInsert);
			//echo ("<br><br>DONNES INSEREE !"); // mettre une redirection réelle des que la page est prête; 
			header("location: manageCategories.php");
			
		}
		//=====================================================================//
		else{//($error == true)
			header("location: createCategories.php?errors=".implode(',', $listOfError));
		}
	} 
	//=====================================================================//
	else{//($_POST est incorrect)
		header("location: tricheur.php");
	}