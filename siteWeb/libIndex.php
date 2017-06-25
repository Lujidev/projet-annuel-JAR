<?php
    require_once "conf.inc.php";

    /**
     * @author: Ronan Sgaravatto
     * @return: 
     */
    function indexGetNewestArticle () {
        $db = dbConnect();
        $query = $db->prepare("SELECT id_article, nom_article, description_article, image FROM ARTICLES WHERE is_deleted = 0"); //rajouter condition sur la date
        $query->execute([]);
        $res = $query->fetchall();

        return $res;
    }

    function displayNewestArticle ($elem) {
        foreach ($elem as $key => $value) {

            $image = randImage();

            echo '<div class="col-md-3 team-left">
                <a href="single.php?id='.$value["id_article"].'"><img src="'.$image.'" alt=""></a>
                <h4>'.$value["nom_article"].'</h4>
            </div>';
        }
    }

    function indexGetNewestProjet () {
        $db = dbConnect();
        $query = $db->prepare("SELECT id_projet, nom_projet, description_projet, categorie_projet FROM PROJETS"); //rajouter condition sur la date
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
        $query = $db->prepare("SELECT id_article, nom_article, description_article, image FROM ARTICLES WHERE is_deleted = 0 AND id = ROUND( RAND() * 9 ) + 1");
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

    function displaySingleArticle(){

        if(!empty($_GET["id"])){
            $db = dbConnect();

            $query = $db->prepare("SELECT * FROM ARTICLES WHERE id_article = :id" );
            $query->execute($_GET);
            $res_data = $query->fetch();


            if(!empty($res_data)){

                $form = [
                    "id_article"=>$res_data["id_article"],
                    "nom_article"=>$res_data["nom_article"],
                    "description_article"=>$res_data["description_article"],
                    "contenu_article"=>$res_data["contenu_article"],
                    "image"=>$res_data["image"]

                ];
            }
        }

        return $form;

    }

    function displayLikes(){

        $db = dbConnect();

        $query = $db->prepare("SELECT * FROM LIKES");
        $query->execute();
        $res = $query->fetch();

        return $res;
    }

function displayDislikes(){

    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM DISLIKES");
    $query->execute();
    $res = $query->fetch();

    return $res;
}

/*function displayNumberOfLike(){
    $db = dbConnect();
    $query = $db->prepare("SELECT MAX(id_article) FROM LIKES ");
    $query->execute();
    $res = $query->fetch();

    return $res;
}

function displayNumberOfDislikes(){
    $db = dbConnect();
    $query = $db->prepare("SELECT MAX(id_article) FROM DISLIKES ");
    $query->execute();
    $res = $query->fetch();

    return $res;
} */

function dbComputer(){

    $db = dbConnect();
    $query = $db->prepare("SELECT * FROM COMPUTER");
    $query->execute();
    $res = $query->fetchAll();

    return $res;
}

function displayComputer($elem){

    foreach ($elem as $key => $value)


        echo "<tr>
            <td>".$value['name_pc']."</td>
            <td>".$value['cpu']."</td>
            <td>".$value['gpu']."</td>
            <td>".$value['ram']."</td>
          </tr>";


}

function likeArticle($id){
    $db = dbConnect();
    $query = $db->prepare("SELECT is_liked FROM ARTICLES WHERE id_article = $id");
    $query->execute($_GET);
    $res = $query->fetch();

    return $res;
}

function dislikeArticle($id){
    $db = dbConnect();
    $query = $db->prepare("SELECT is_disliked FROM ARTICLES WHERE id_article = $id");
    $query->execute($_GET);
    $res = $query->fetch();

    return $res;
}