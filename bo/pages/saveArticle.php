<?php
	require "conf.inc.php";
	require "lib.php";

	if (!empty($_POST)
		&& isset($_POST["nom_article"])
		&& isset($_POST["description_article"])
		&& isset($_POST["contenu_article"]) ){

		$error = false;
		$listOfError = array();

		$nom_article = trim($_POST["nom_article"]);
		if (strlen($nom_article) > 50 || strlen($nom_article) < 3 ){
			$error = true;
			$listOfError[] = 5;
		}

		$description_article = trim($_POST["description_article"]);
		if (strlen($description_article) > 100 || strlen($description_article) < 0 ){
			$error = true;
			$listOfError[] = 6;
		}

		/*
			Vérification sur le contenu à ajouter
		*/
		
		//=====================================================================//
		if (!$error){
			$db = dbConnect();
			
			//=====================================================================//
			if (isset($_POST["from"]) && $_POST["from"] == "creerArticle"){

				if (!verifyPresent("ARTICLES", "nom_article", $nom_article)){

				    //====================================================//

                    //Traitement de le image

                   $myImage = uploadImage($_FILES["image"], "article");


					//Si on vient de la page creerArticle, alors la requête préparée est une insertion
					$query = $db->prepare("INSERT INTO ARTICLES (nom_article, description_article, categorie_article, contenu_article, image) VALUES(:nom_article, :description_article, :categorie_article, :contenu_article, :image)");
					
					//Récupération des catégories selectionnées par l'utilisateur
					$categories = getSelectedCategories ($_POST, "a");

					$dataToInsert = [
						        'nom_article' => $nom_article, 
						"description_article" => $description_article, 
						  "categorie_article" => $categories,
						  	"contenu_article" => $_POST["contenu_article"],
                        "image" => $myImage
					];

				}
				else{// Le nom est déjà dans la bdd
					$listOfError[] = 2;
					header("location: createArticle.php?errors=".implode(',', $listOfError));
				}
			}
			//=====================================================================//
			elseif (isset($_POST["from"]) && $_POST["from"] == "modifierArticle") {
				echo "coucou";
			}
			//=====================================================================//
			$query->execute($dataToInsert);
			header("location: manageArticle.php");
			
		}
		//=====================================================================//
		else{//($error == true)
			header("location: createArticle.php?errors=".implode(',', $listOfError));
		}
	} 
	//=====================================================================//
	else{//($_POST est incorrect)
		header("location: tricheur.php");
	}