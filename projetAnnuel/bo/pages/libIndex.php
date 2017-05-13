<?php
    require_once "conf.inc.php";
    require_once "lib.php";

    function indexGetNewestArticle () {
        $db = dbConnect();
        $query = $db->prepare("SELECT id_article, nom_article, description_article, image FROM ARTICLES WHERE  is_delete = 0"); //rajouter condition sur la date
        $query->execute([]);
        $res = $query->fetchall();

        return $res;
    }

    function displayNewestArticle ($elem) {
        foreach ($elem as $key => $value) {
            echo '<div class="col-md-3 team-left">
                <img src="'.$value["image"].'" alt="">
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