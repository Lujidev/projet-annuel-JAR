<?php
    require_once "conf.inc.php";
    require_once "lib.php";

    /**
     * @author: Ronan Sgaravatto
     * @return: 
     */
    function indexGetNewestArticle () {
        $db = dbConnect();
        $query = $db->prepare("SELECT id_article, nom_article, description_article, image FROM ARTICLES WHERE is_delete = 0"); //rajouter condition sur la date
        $query->execute([]);
        $res = $query->fetchall();

        return $res;
    }

    function displayNewestArticle ($elem) {
        foreach ($elem as $key => $value) {

            $image = randImage();

            echo '<div class="col-md-3 team-left">
                <img src="'.$image.'" alt="">
                <h4>'.$value["nom_article"].'</h4>
                <p>'.$value["description_article"].'</p>
            </div>';
        }
    }

    function indexGetNewestProjet () {
        $db = dbConnect();
        $query = $db->prepare("SELECT id_projet, nom_projet, description_projet, categorie_projet FROM PROJETS WHERE is_delete = 0"); //rajouter condition sur la date
        $query->execute([]);
        $res = $query->fetchall();

        return $res;
    }

    function displayNewestProjet ($elem) {
        foreach ($elem as $vv) {
            $cat[] = explode(',', $vv["categorie_projet"]);
        }
        

        foreach ($elem as $key => $value) {
            echo '<div class="col-md-3 team-left">
                <h4>'.$value["nom_article"].'</h4>
                <p>'.$value["description_article"].'</p>
                <ul>';
                foreach ($cat as $kc => $vc) {
                    echo "<li>".$vc;
                }
                echo '</ul>
            </div>';
        }
    }

    /**
     * @author: Jing Lin
     * @return: TEMPORAIRE: un chemin vers une image aléatoire.
     	On est entrain de debug l'upload d'image personnalisée.
     */


    function randImage (){

        $listOfImages = scandir("imageLib");
        $image = "imageLib/".$listOfImages[rand(2,7)];

        return $image;
    }

    /**
     * @author: Jing Lin
     * @return: TEMPORAIRE: un carousel.
     	On est entrain de debug l'upload d'image personnalisée.
     */


    function carousel(){
    	$listOfImages = scandir("imageLib");

    	foreach ($listOfImages as $value) {
    		$image = "imageLib/".$value;

   			echo '<li>
				<a href="#">
					<div class="banner-1">
						<img src="'.$image.'" class="img-responsive" alt="">
					</div>
				</a>
			</li>';
    	}

    }

    /**
     * @author: Jing Lin
     * @return: Un article aléatoire.
     */


    function indexGetRandomNewestArticle () {
        $db = dbConnect();
        $query = $db->prepare("SELECT id_article, nom_article, description_article, image FROM ARTICLES WHERE is_delete = 0 AND id = ROUND( RAND() * 9 ) + 1");
        $query->execute([]);
        $res = $query->fetch();

        return $res;
    }

    /**
     * @author: Jing Lin
     * @return: Pas encore intégré le random, mais affiche les dernier articles.
     */


    function randomArticleInterest($elem){

    	foreach ($elem as $key => $value) {

            $image = randImage();

            echo '<div class="might-grid">
            		<div class="grid-might">
            			<a href="#"><img src="'.$image.'" class="img-responsive" alt=""></a>
            		</div>
					<div class="might-top">
						<h4><a href="#">'.$value["nom_article"].'</a></h4>
						<p>'.$value["description_article"].'</p>
					</div>
					<div class="clearfix"></div>
				</div>';
        }
    }