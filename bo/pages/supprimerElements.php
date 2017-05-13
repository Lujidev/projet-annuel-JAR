<?php
require_once "conf.inc.php";
require_once "lib.php";


	if (isset($_GET) && !empty($_GET["id"]) && !empty($_GET["page"])){

		echo "<pre>";print_r($_GET);

		switch ($_GET["page"]) {
			case 1://Supprimer un commentaire
				deleteElement ("COMMENTAIRES", "id_commentaire", $_GET["id"]);
				header("location: gererCommentaire.php");
				break;
				
			case 2://Supprimer un article
				deleteElement ("ARTICLES", "id_article", $_GET["id"]);
				header("location: gererArticle.php");
				break;
			
			case 3://Supprimer un utilisateur
				deleteElement ("UTILISATEURS", "id_utilisateur", $_GET["id"]);
				header("location: gererUtilisateur.php");
				break;

			case 4://Supprimer une equipe
				destroyElement ("EQUIPES", "nom_equipe", $_GET["id"]);
				header("location: gererEquipe.php");
				break;

			case 5://Supprimer un projet
				destroyElement ("PROJETS", "id_projet", $_GET["id"]);
				header("location: gererProjet.php");
				break;

			case 6://Supprimer une catégotie
				destroyElement ("CATEGORIES", "id_categorie", $_GET["id"]);
				header("location: gererCategorie.php");
				break;
		}
	}
	else{
		header("location: tricheur.php");
	}
	
