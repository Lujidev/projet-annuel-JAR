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
            $query = $db->prepare("SELECT * FROM UTILISATEURS WHERE access_token=:token AND email=:email AND is_deleted=0");
            $query->execute([
                "token"=>$_SESSION["access_token"],
                "email"=>$_SESSION["email"]
            ]);

            $res = $query->fetch();

            if (empty($res)){
                unset($_SESSION["access_token"]);
                header("location: login.php");
            }
            else{
               return $res;
                //return true;
            }
        }
        header("location: login.php");
    }

    function disconnect(){
        //if (isset($_SESSION["access_token"])){
        //session_start();
    	$db = dbConnect();
    	$query = $db->prepare("UPDATE UTILISATEURS SET access_token=NULL WHERE email=:email");
    	$query->execute(["email"=>$_SESSION["email"]]);

    	unset ($_SESSION["access_token"]);
        unset ($_SESSION["email"]);
        unset ($_SESSION["id_utilisateur"]);
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
     * @author: Jing LIN
     * @return: Pleins de get depuis la BDD en tout genre, c'est bien cool.
     */
    function getUsers(){
        $db = dbConnect();
        $query = $db->prepare("SELECT * FROM UTILISATEURS WHERE is_deleted=0");
        $query->execute([]);
        $res = $query->fetchAll();

        return $res;
    }

    function getTeams($user, $role){
		$db = dbConnect();
		if ($role != '3'){
            $query = $db->prepare("SELECT * FROM equipes WHERE createur = :createur");
            $query->execute([
                "createur"=>$user
            ]);
        }
        if ($role == '3'){
            $query = $db->prepare("SELECT * FROM equipes");
            $query->execute([
            ]);

        }

		$res = $query->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    function getArticles($user, $role){
		$db = dbConnect();

		if ($role != '3'){
            $query = $db->prepare("SELECT * FROM ARTICLES WHERE is_deleted=0 AND auteur = :auteur");
            $query->execute([
                "auteur"=>$user
            ]);
        }
        if ($role == '3'){
            $query = $db->prepare("SELECT * FROM ARTICLES WHERE is_deleted=0");
            $query->execute([
            ]);

        }


		$res = $query->fetchAll();

        return $res;
    }

    function getProjects($user, $role){
	    $db = dbConnect();
        if ($role != '3'){
            $query = $db->prepare("SELECT * FROM PROJETS WHERE createur = :createur");
            $query->execute([
                "createur"=>$user
            ]);

        }
        if ($role == '3'){
            $query = $db->prepare("SELECT * FROM PROJETS");
            $query->execute([]);
        }

	    $res = $query->fetchAll();

        return $res;
    }


   	function getCategoriesCharge(){
		$db = dbConnect();
		$query = $db->prepare("SELECT * FROM categories");
		$query->execute([]);
		$res = $query->fetchAll();

   		return $res;
   	}

    /**
     * @author: Ronan Sgaravatto
     * @return: Retourne un token généré aléatoirement à chaque tirage. Possibilité de mettre un salt en paramètre
     */
    function createToken ($salt = "vefuhzlmfqdfibhdsvqsfejkbpoufncodighbdvpsqmzfpçe"){
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
            /*echo "<div class='checkbox'>
                    <label><input type='checkbox' name='".$value['nom_categorie']."' value='".$value['id_categorie']."'>".$value['nom_categorie']."</label>
                  </div>";*/
            echo "<input type='checkbox' class='flat' name='".$value['nom_categorie']."' value='".$value['id_categorie']."' />".$value['nom_categorie']."<br />";
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les Equipes.
     */
    function manageTeams ($variable) {
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT nom_categorie FROM categories WHERE id_categorie=:id_categorie");
            $query->execute([
                "id_categorie" => $value['categorie_equipe']
            ]);
            $res = $query->fetch();
            echo "<tr>
             <td>
                <input type='checkbox' id='check-all' class='flat' name='delete[]' value=".$value['id'].">
            </td>
            <td>".$value['nom_equipe']."</td>
            <td>".$value['description_equipe']."</td>
            <td>".$value['nb_article']."</td>
            <td>".$res['nom_categorie']."</td>
            <td><a href=modifyArticle.php?id=".$value['nom_equipe'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les projets.
     */
    function manageProjects ($variable) {
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT nom_categorie FROM categories WHERE id_categorie=:id_categorie");
            $query->execute([
                "id_categorie" => $value['categorie_projet'],
            ]);
            $res = $query->fetch();

            echo "<tr>
             <td>
                <input type='checkbox' id='check-all' class='flat' name='delete[]' value=".$value['id_projet'].">
            </td>
            <td>".$value['id_projet']."</td>
            <td>".$value['nom_projet']."</td>
            <td>".$value['description_projet']."</td>
            <td>".$res['nom_categorie']."</td>
            <td><a href=modifyProject.php?id=".$value['id_projet'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Ronan Sgaravatto
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les categories.
     */
    function manageCategories ($variable) {
        foreach ($variable as $key => $value) {
            echo "<tr>
            <td>
                <input type='checkbox' id='check-all' class='flat' name='delete[]' value=".$value['id_categorie'].">
            </td>
            <td>".$value['id_categorie']."</td>
            <td>".$value['nom_categorie']."</td>
            <td>".$value['description_categorie']."</td>
            <td>".$value['filter']."</td>
            <td><a href=modifyCategories.php?id=".$value['id_categorie'].">Modifier</a></td>
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
            <td><a href=removeElements.php?id=".$value['id_commentaire']."&amp;page=1>Supprimer</a>
            <td><a href=modifyComment.php?id=".$value['id_commentaire'].">Modifier</a></td>
            </tr>";
        }
    }

    /**
     * @author: Jing Lin
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les articles.
     */
    function manageArticles ($variable) {
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT nom_categorie FROM categories WHERE id_categorie=:id_categorie");
            $query->execute([
                "id_categorie" => $value['categorie_article'],
            ]);
            $res = $query->fetch();

            echo "<tr>
            <td>
                <input type='checkbox' id='check-all' class='flat' name='delete[]' value=".$value['id_article'].">
            </td>
            <td>".$value['id_article']."</td>
            <td>".$value['nom_article']."</td>
            <td>".$value['description_article']."</td>
            <td>".$res['nom_categorie']."</td>
            <td><a href=modifyArticle.php?id=".$value['id_article'].">Modifier</a></td>
            </tr>";
        }
    }


    /**
     * @author: Jing Lin
     * @return: Permet d'afficher un tableau avec des données appelées de la base de données. Utilisé pour gerer les utilisateurs.
     */
    function manageUsers ($variable) {
        
        foreach ($variable as $key => $value) {
            $db = dbConnect();
            $query = $db->prepare("SELECT role FROM DROITS WHERE id_droit=:id_droit");
            $query->execute([
                "id_droit" => $value['droit'],
            ]);
            $res = $query->fetch();

            $role = utf8_encode($res['role']);

            echo "<tr>
            <td>
                <input type='checkbox' id='check-all' class='flat' name='delete[]' value=".$value['id_utilisateur'].">
            </td>
            <td>".$value['id_utilisateur']."</td>
            <td>".$value['pseudo']."</td>
            <td>".$value['email']."</td>
            <td>".$role."</td>
            <td>".$value['date_creation']."</td>
            <td>".$value['activation']."</td>
            <td><a href=modifyUser.php?id=".$value['id_utilisateur'].">Modifier</a></td>
            </tr>";



            
            /*echo "<tr class='odd gradex'>
            <td>".$value['id_utilisateur']."</td>
            <td>".$value['pseudo']."</td>
            <td>".$value['email']."</td>
            <td>".$role."</td>
            <td>".$value['date_creation']."</td>
            <td>".$value['activation']."</td>
            <td><a href=removeElements.php?id=".$value['id_utilisateur']."&amp;page=3>Supprimer</a>
            <td><a href=modifyUser.php?id=".$value['id_utilisateur'].">Modifier</a></td>
            </tr>";*/
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
        $query = $db->prepare("UPDATE ".$table." SET is_deleted=1 WHERE ".$nameCol."=:".$nameCol);
        $query->execute( [$nameCol=>$val] );
    }


/**
 * @author: Jing LIN
 * @return: Upload l'image et retourne le chemin vers celui ci
 * $image = $_FILES["name"] si envoyé par formulaire.
 * $path = le sous dossier du dossier upload dans lequel tu veux enregistrer ton image, par exemple "article" pour /upload/article.
 */

    function uploadImage ($image, $path){

        define("UPLOAD_PATH", "./upload/$path");

        /*définition des extensions autorisées*/

        //$filesAutorized1 = ["jpeg"];
        $filesAutorized = array( 'jpg' , 'jpeg', 'png', 'JPEG', 'PNG', 'JPG');


        /*Vérification de s'il y a bien 2 fichiers choisi*/

        if (!empty($image)){


            /*création du dossier d'upload temporaire qui sera supprimé après s'il n'existe pas*/

            if ( !file_exists(UPLOAD_PATH) ) {
                mkdir(UPLOAD_PATH);
            }


            /*Création des variable pour éviter les erreurs*/

            $myImage = '';
            $erreur = 0;


            /*On donne un nom unique au fichier upload*/

            $file = $image;

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

                return $name;
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

                return $message;
            }

        }
    }





/**
 * @author: Jing LIN
 * @return: Fonction qui ajoute une notification à la bdd.
 */


function addNotif($preview, $sujet, $notif_desc, $id_link, $filter){

    $db = dbConnect();
    $query = $db->prepare("INSERT INTO NOTIFICATIONS (preview, sujet, notif_desc, id_link, filter) VALUES(:preview, :sujet, :notif_desc, :id_link, :filter)");
    $query->execute( [
        "preview"=>$preview,
        "sujet"=>$sujet,
        "notif_desc"=>$notif_desc,
        "id_link"=>$id_link,
        "filter"=>$filter
    ] );


}

/**
 * @author: Jing LIN
 * @return: Affiche les notifications
 */

function showNotif($id){

    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM NOTIFICATIONS WHERE id_link=:id_link");
    $query->execute( [
        "id_link"=>$id
    ] );

    $res = $query->fetchAll();

    foreach ($res as $value){

        if ($value['filter'] == 'message'){

            echo '      <li>
                      <a href="mp.php" onclick="viewNotif(' .$value["id_notif"].')">
                        <span class="image"><img src="'.$value["preview"].'" alt="Profile Image" /></span>
                        <span>
                          <span>'.$value["sujet"].'</span>
                          <span class="time">'.$value["send_time"].'</span>
                        </span>
                        <span class="message">
                          '.$value["notif_desc"].'
                        </span>
                      </a>
                    </li>';

        }else{
            echo '      <li>
                      <a href="'.$value['filter'].'" onclick="viewNotif(' .$value["id_notif"].')">
                        <span class="image"><img src="'.$value["preview"].'" alt="Profile Image" /></span>
                        <span>
                          <span>'.$value["sujet"].'</span>
                          <span class="time">'.$value["send_time"].'</span>
                        </span>
                        <span class="message">
                          '.$value["notif_desc"].'
                        </span>
                      </a>
                    </li>';
        }


    };











}

/**
 * @author: Jing LIN
 * @return: return le nombre de notification.
 */


function nbNotif($id){

    $db = dbConnect();
    $query = $db->prepare("SELECT COUNT(id_notif) AS nbNotif FROM NOTIFICATIONS WHERE id_link=:id_link");
    $query->execute( [
        "id_link"=>$id
    ] );

    $res = $query->fetch();

    return $res['nbNotif'];

}

/**
 * @author: Jing LIN
 * @return: return le nombre de message non lu
 */

function nbMsgNotRead($id){

    $db = dbConnect();
    $query = $db->prepare("SELECT COUNT(id_mp) AS nbNotif FROM MESSAGESP WHERE destinataire_mp=:destinataire_mp AND is_read_mp = '0'");
    $query->execute( [
        "destinataire_mp"=>$id
    ] );

    $res = $query->fetch();

    return $res['nbNotif'];

}

/**
 * @author: Jing LIN
 * @return: retour l'avatar de la personne avec son $id.
 */


function getAuthorImg($id){

    $db = dbConnect();
    $query = $db->prepare("SELECT avatar FROM UTILISATEURS WHERE id_utilisateur=:id_utilisateur");
    $query->execute( [
        "id_utilisateur"=>$id
    ] );

    $res = $query->fetch();

    return $res['avatar'];

}


/**
 * @author: Jing LIN
 * @return: Permet d'envoyer un email de confirmation permettant à la personne d'activer son compte.
 * Entrée: $email: email de l'utilisateur, $validationKey: La clé de validation généré pour la comparaison et l'activation.
 * Utilisation de phpMailer
 */

function sendConfirmationMail($email, $validationKey){

    require 'phpmailer/PHPMailerAutoload.php';

    $mailer = New PhpMailer();
    $mailer->IsSMTP();
    $mailer->IsHTML=TRUE;
    $mailer->Username = "dumbitproject@gmail.com";
    $mailer->Password = "Project123456";
    $mailer->Host = "smtp.gmail.com";
    $mailer->Port = 465;
    $mailer->SMTPSecure = 'ssl';
    $mailer->SMTPAuth = true;

    $mailer->FromName = "Dumb IT";
    $mailer->addAddress($email);

    $mailer->Subject="Activation de votre compte DumbIT";

    $data = "Bonjour, vous avez récement crée un compte sur DumbIT. Cliquez sur le lien pour activer votre compte.
    
    Activer votre compte: http://localhost/projet-annuel-JAR/boV2/activate.php?token=".$validationKey;
    $msg = utf8_decode($data);
    $mailer->Body= $msg;

    if(!$mailer->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mailer->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }


}

/**
 * @author: Jing LIN
 * @return: retour le dernier id d'une table.
 * $col = le nom de la colonne
 * $table = la table
 */

function getSqlLast($col, $table){

    $db = dbConnect();
    $query = $db->prepare("SELECT ".$col." FROM ".$table." ORDER BY ".$col." DESC LIMIT 1");
    $query->execute([
    ]);
    $last_id = $query->fetch();
    return $last_id[$col];

}

function getAllUsers(){

    $db = dbConnect();

    $query = $db->prepare(
        "SELECT * FROM UTILISATEURS"
    );

    $query->execute([
    ]);

    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    return $res;

}

