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

                    define("UPLOAD_PATH", "./upload/article");

                    /*définition des extensions autorisées*/

                    //$filesAutorized1 = ["jpeg"];
                    $filesAutorized = array( 'jpg' , 'jpeg', 'png', 'JPEG', 'PNG', 'JPG');


                    /*Vérification de s'il y a bien 2 fichiers choisi*/

                    if (!empty($_FILES["image"])){


                        /*création du dossier d'upload temporaire qui sera supprimé après s'il n'existe pas*/

                        if ( !file_exists(UPLOAD_PATH) ) {
                            mkdir(UPLOAD_PATH);
                        }

                        /*Création des variable pour éviter les erreurs*/

                        $myImage = '';
                        $erreur = 0;


                        /*On donne un nom unique au fichier upload*/

                        $file = $_FILES["image"];

                        $fileInfo = pathinfo($file["name"]);

                        $name = uniqid().".".$fileInfo["extension"];


                        /*Vérification de l'extension du fichier*/

                        if ( !in_array($fileInfo["extension"], $filesAutorized)){

                            $file["error"] = UPLOAD_ERR_EXTENSION;

                            $erreur = 7;

                        }

                        /*On déplace l'image pour pouvoir l'utiliser plus simplement*/

                        if($file["error"] == 0){

                            $myImage = UPLOAD_PATH."/".$name;

                            move_uploaded_file($file["tmp_name"],$myImage);

                            if($fileInfo["extension"] == 'jpeg'){

                                $destination = imagecreatefromjpeg($myImage);

                            }
                            if($fileInfo["extension"] == 'jpg'){

                                $destination = imagecreatefromjpeg($myImage);

                            }
                            if($fileInfo["extension"] == 'png'){

                                $destination = imagecreatefrompng($myImage);

                            }

                        }

                        /*Switch pour les différents erreurs*/
                        else{

                            switch ($file["error"]) {
                                case UPLOAD_ERR_INI_SIZE:
                                    $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                                    break;
                                case UPLOAD_ERR_FORM_SIZE:
                                    $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                                    break;
                                case UPLOAD_ERR_PARTIAL:
                                    $message = "The uploaded file was only partially uploaded";
                                    break;
                                case UPLOAD_ERR_NO_FILE:
                                    $message = "No file was uploaded";
                                    break;
                                case UPLOAD_ERR_NO_TMP_DIR:
                                    $message = "Missing a temporary folder";
                                    break;
                                case UPLOAD_ERR_CANT_WRITE:
                                    $message = "Failed to write file to disk";
                                    break;
                                case UPLOAD_ERR_EXTENSION:
                                    $message = "File upload stopped by extension";
                                    break;

                                default:
                                    $message = "Unknown upload error";
                                    break;
                            }

                            /*Affichage du message d'erreur si problème il y a*/

                            echo $message;
                        }

                    }


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