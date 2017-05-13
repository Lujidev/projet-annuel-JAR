<?php
require_once "conf.inc.php";

    function dbConnect(){
        try{
            $db = new PDO(
                DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
        }
        catch(Exception $e){
            die ("Erreur SQL ".$e->getMessage());
        }
        return $db;
    }

    function isConnected(){
        
        if (!empty($_SESSION["access_token"])){
            $db = dbConnect();
            $query = $db->prepare("SELECT id_utilisateur FROM UTILISATEURS WHERE access_token=:token AND email=:email AND is_deleted=0");
            $query->execute([
                "token"=>$_SESSION["access_token"],
                "email"=>$_SESSION["email"]
            ]);
            
            if (empty($query->fetch())){
                unset($_SESSION["access_token"]);
                return false;
            }
            else{
                return true;
            }
        }
        return false;
    }

    function disconnect(){
        //if (isset($_SESSION["access_token"])){
        session_start();
    	$db = dbConnect();
    	$query = $db->prepare("UPDATE UTILISATEURS SET access_token=NULL WHERE email=:email");
    	$query->execute(["email"=>$_SESSION["email"]]);

    	unset ($_SESSION["access_token"]);
        //}
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Retourne les catégories en fonction du filtre.
     */
    function getCategories( $filter ){
        $db = dbConnect();
        $query = $db->prepare("SELECT id_categorie FROM CATEGORIES WHERE filter=:filter");
        $query->execute( ["filter"=>$filter] );

        return $query->fetchAll();
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Retourne un token généré aléatoirement à chaque tirage. Possibilité de mettre un salt en paramètre
     */
    function createToken ($salt = "vefuhzlmfqdfibhdsvqsf, ejkb poufncodighbdvpsqmzfpçe"){
        return md5(uniqid().$salt.time().substr($salt, rand(3, strlen($salt) - 3)));
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Cherche la valeur passée en paramètre, retourne true si elle est présente et false si elle n'y est pas.
     */
    function verifyPresent($table, $colonne, $valeur){
        $db = dbConnect();
        $query = $db->prepare("SELECT ".$colonne." FROM ".$table." WHERE ".$colonne."=:".$colonne);
        $query->execute( [':'.$colonne=>$valeur] );
        $res = $query->fetch();

        return !$res ? false : true;
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet de récupérer les catégories.
     */
    function getSelectedCategories ($post, $catFilter){
            $dbCategorie = getCategories($catFilter);  // Catégories stockées en bdd
            $categories = array();              // Contiendra les catégories selectionnées par l'utilisateur

            foreach ($post as $vpost){
                foreach ($dbCategorie as $categorie){
                    if ($categorie["id_categorie"] == $vpost){
                        $categories[] = $vpost;
                    }
                }
            }
        return implode(',', $categories);
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Après vérification, s'il y a des erreurs à afficher alors on créé une liste avec les messages à afficher.
     */
    function printErrorMsg($errors, $errorMsg) {
        echo "<ul>";
        $msg = explode(',', $_GET["errors"]);
        foreach ($msg as $key => $value)
            echo "  <li class='msg-error'>".$errorMsg[$value];
        echo "</ul>";  
    }
    
    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher les catégories appelées de la base de données sous la forme de checkbox dans le formulaire.
     */
    function displayCategories ($categorie) {
        foreach ($categorie as $key => $value) {
            echo "<label> ".$value['nom_categorie']." <input type='checkbox' name='".$value['nom_categorie']."' value='".$value['id_categorie']."'></label>";
        }
    }

    /**
     * @author: Jing Lin
     * @return: Permet d'afficher les catégories appelées de la base de données sous la forme de checkbox en vertical dans le formulaire + template.
     */
    function SkinDisplayCategories ($categorie) {
        foreach ($categorie as $key => $value) {
            echo "<div class='checkbox'>
                    <label><input type='checkbox' name='".$value['nom_categorie']."' value='".$value['id_categorie']."'>".$value['nom_categorie']."</label>
                  </div>";
        }
    }

    /**
     * @author: Jing Lin
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Ceci est la version générique utilisable pour plusieurs tables différentes.'
     */
    function pageGerer ($variable) {
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT nom_categorie FROM categories WHERE id_categorie=:id_categorie");
            $query->execute([
                "id_categorie" => $value['categorie_equipe'],
            ]);
            $res = $query->fetch();
            echo "<tr class='odd gradex'>
            <td>".$value[0]."</td>
            <td>".$value[1]."</td>
            <td>".$value[2]."</td>
            <td>".$res['nom_categorie']."</td>
            <td><a href=supprimerUtilisateur.php?id=".$value[0].">Supprimer</a>
            <td><a href=modifierUtilisateur.php?id=".$value[0].">Modifier</a></td>
            </tr>";
            print_r($res);
            echo "<br>";  
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les Equipes.
     */
    function gererEquipes ($variable) {
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT nom_categorie FROM categories WHERE id_categorie=:id_categorie");
            $query->execute([
                "id_categorie" => $value['categorie_equipe'],
            ]);
            $res = $query->fetch();
            echo "<tr class='odd gradex'>
            <td>".$value['nom_equipe']."</td>
            <td>".$value['description_equipe']."</td>
            <td>".$value['nb_article']."</td>
            <td>".$res['nom_categorie']."</td>
            <td><a href=supprimerElements.php?id=".$value['nom_equipe']."&amp;page=4>Supprimer</a>
            <td><a href=modifierArticle.php?id=".$value['nom_equipe'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les projets.
     */
    function gererProjets ($variable) {
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT nom_categorie FROM categories WHERE id_categorie=:id_categorie");
            $query->execute([
                "id_categorie" => $value['categorie_projet'],
            ]);
            $res = $query->fetch();
            echo "<tr class='odd gradex'>
            <td>".$value['id_projet']."</td>
            <td>".$value['nom_projet']."</td>
            <td>".$value['description_projet']."</td>
            <td>".$res['nom_categorie']."</td>
            <td><a href=supprimerElements.php?id=".$value['id_projet']."&amp;page=5>Supprimer</a>
            <td><a href=modifierProjet.php?id=".$value['id_projet'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les categories.
     */
    function gererCategories ($variable) {
        foreach ($variable as $key => $value) {
            echo "<tr class='odd gradex'>
            <td>".$value['id_categorie']."</td>
            <td>".$value['nom_categorie']."</td>
            <td>".$value['description_categorie']."</td>
            <td>".$value['filter']."</td>
            <td><a href=supprimerElements.php?id=".$value['id_categorie']."&amp;page=6>Supprimer</a>
            <td><a href=modifierCategorie.php?id=".$value['id_categorie'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les articles.
     */
    function gererCommentaires ($variable) {
        foreach ($variable as $key => $value) {
            echo "<tr class='odd gradex'>
            <td>".$value['id_commentaire']."</td>
            <td>".$value['contenu']."</td>
            <td>".$value['date_publication']."</td>
            <td>".$value['date_modification']."</td>
            <td>".$value['is_delete']."</td>
            <td>".$value['article']."</td>
            <td><a href=supprimerElement.php?id=".$value['id_commentaire']."&amp;page=1>Supprimer</a>
            <td><a href=modifierCommentaire.php?id=".$value['id_commentaire'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Jing Lin
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les articles.
     */
    function gererArticles ($variable) {
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT nom_categorie FROM categories WHERE id_categorie=:id_categorie");
            $query->execute([
                "id_categorie" => $value['categorie_article'],
            ]);
            $res = $query->fetch();
            echo "<tr class='odd gradex'>
            <td>".$value['id_article']."</td>
            <td>".$value['nom_article']."</td>
            <td>".$value['description_article']."</td>
            <td>".$res['nom_categorie']."</td>
            <td><a href=supprimerElements.php?id=".$value['id_article']."&amp;page=2>Supprimer</a>
            <td><a href=modifierArticle.php?id=".$value['id_article'].">Modifier</a></td>
            </tr>";
        }
    }


    /**
     * @author: Jing Lin
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les utilisateurs.
     */
    function gererUtilisateurs ($variable) {
        
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT role FROM DROITS WHERE id_droit=:id_droit");
            $query->execute([
                "id_droit" => $value['droit'],
            ]);
            $res = $query->fetch();
            
            echo "<tr class='odd gradex'>
            <td>".$value['id_utilisateur']."</td>
            <td>".$value['pseudo']."</td>
            <td>".$value['email']."</td>
            <td>".$res['role']."</td>
            <td>".$value['date_creation']."</td>
            <td>".$value['activation']."</td>
            <td><a href=supprimerElements.php?id=".$value['id_utilisateur']."&amp;page=3>Supprimer</a>
            <td><a href=modifierUtilisateur.php?id=".$value['id_utilisateur'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Supprime la ligne de la table passée en paramètre
     */
    function destroyElement ($table, $nameCol, $val) {
        $db = dbConnect();
        $query = $db->prepare("DELETE FROM ".$table." WHERE ".$nameCol."=:".$nameCol);
        $query->execute( [$nameCol=>$val] );
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Met is_delete à 1 dans la ligne selectionnée
     */
    function deleteElement ($table, $nameCol, $val) {
        $db = dbConnect();
        $query = $db->prepare("UPDATE ".$table." SET is_delete=1 WHERE ".$nameCol."=:".$nameCol);
        $query->execute( [$nameCol=>$val] );
    }