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
     * @return: Retourne un token généré aléatoirement à chaque tirage.
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
