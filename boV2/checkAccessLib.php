<?php
require "project/libProject.php";
//Verification d'indentité sur les pages.



/**
 * @author: Jing LIN
 * @return: Check si l'utilisateur a acces à cette page de projet.
 */
function isAuthorized_projet($userId, $userRole, $projectId){

   if ($userRole == 3){
        return true;
    }
    $userTeams = getMemberTeam($userId);

    $allUserProject = [];
    foreach ($userTeams as $value){
        foreach ($value as $val){
            array_push($allUserProject, $val["id_projet"]);
        }
    }

    // On vérifie s'il y a une correspondance
    foreach ($allUserProject as $value){
        if ($value == $projectId){
            return true;
        }
    }
    // on utilise du js pour rediriger aulieu du header location parce qu'on a dû echo des choses dans le header.
echo'
        <script type="text/javascript">
            window.location.href = \'page404.html\';
        </script>
';

}

/**
 * @author: Jing LIN
 * @return: Check si l'utilisateur a acces à cette page de team.
 */

function isAuthorized_team($userId, $userRole, $teamId){

    if ($userRole == 3){
        return true;
    }

    $userTeams = getTeams($userId, $userRole);

    $allUserTeams = [];
    foreach ($userTeams as $value){

        array_push($allUserTeams, $value["id"]);

    }

    foreach ($allUserTeams as $value){
        if ($value == $teamId){
            return true;
        }
    }

    echo'
        <script type="text/javascript">
            window.location.href = \'page404.html\';
        </script>
';
}


function isAuthorized_admin($userRole){

    if ($userRole != 3){
        echo'
        <script type="text/javascript">
            window.location.href = \'page404.html\';
        </script>
';

    }
}

?>