<?php
	session_start();
require "lib.php";
	isConnected();


    if( !empty($_POST['pseudo']) &&
        !empty($_POST['email']) &&
        !empty($_POST['pwd']) &&
        !empty($_POST['pwd2'])
        //!empty($_POST['captcha'])
        ){

		$error = false;
		$listOfError = array();

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
			if (isset($_POST["from"]) && $_POST["from"] == "creerUtilisateur"){

				if (!verifyPresent("UTILISATEURS", "pseudo", $pseudo)){

                    $myImage = uploadImage($_FILES["image"], "user");

					//Si on vient de la page creerUtilisateur, alors la requête préparée est une insertion
					$query = $db->prepare("INSERT INTO UTILISATEURS (pseudo, email, avatar, mdp, presentation, droit) VALUES(:pseudo, :email, :avatar, :pwd, :pres, :droit)");
					
					//Récupération des catégories selectionnées par l'utilisateur
					$pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

					$dataToInsert = [
						        "pseudo" => $pseudo, 
								 "email" => $email,
                                "avatar"=> $myImage,
						  		   "pwd" => $pwd,
						  		  "pres" => $presentation,
						  		 "droit" => 2
					];

				}
				else{// Le nom est déjà dans la bdd
					$listOfError[] = 2;
					header("location: createUser.php?errors=".implode(',', $listOfError));
				}
			}
			//=====================================================================//
			elseif (isset($_POST["from"]) && $_POST["from"] == "modifierUtilisateur") {
				echo "coucou";
			}
			//=====================================================================//

			$query->execute($dataToInsert);
			//echo ("<br><br>DONNES INSEREE !"); // mettre une redirection réelle des que la page est prête; 
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