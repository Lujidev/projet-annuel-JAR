<?php
function getMemberTeam($userId, $userRole){

    if ($userRole == 3){

        $db = dbConnect();

        $query = $db->prepare("SELECT id as id_team FROM EQUIPES");
        $query->execute([
        ]);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        //print_r($res);

    }else{

        $db = dbConnect();

        $query = $db->prepare("SELECT id_team FROM TEAMMATES WHERE id_user=:id_user AND is_accepted = :is_accepted");
        $query->execute([
            "id_user"=>$userId,
            "is_accepted"=>1
        ]);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        //print_r($res);
    }



    $dataArray = [];

    foreach ($res as $value){

        $query = $db->prepare("SELECT * FROM PROJETS WHERE id_team=:id_team");
        $query->execute([
            "id_team"=>$value["id_team"]
        ]);

        $gotProject = $query->fetchAll(PDO::FETCH_ASSOC);

        array_push($dataArray, $gotProject);
    }

    return $dataArray;

}


function getTeamName($teamId){

    $db = dbConnect();

    $query = $db->prepare("SELECT nom_equipe FROM EQUIPES WHERE id=:id");
    $query->execute([
        "id"=>$teamId
    ]);

    $gotTeam = $query->fetch(PDO::FETCH_ASSOC);

    return $gotTeam['nom_equipe'];

}

function displayProjectList($data, $userId, $userRole){

    foreach ($data as $value){

        foreach ($value as $val){

            $teamName = getTeamName($val["id_team"]);
            $projectId = $val["id_projet"];
            $percentage = calculPercentage($projectId)."%";
            $warning = checkProjectStatut($projectId);
            $button = rigthButton($percentage, $warning);

            //check createur
            $checkCreator = isCreatorOfTeam($val["id_team"], $userId);

            if(!empty($checkCreator) || $userRole == 3){
                $deleteButton = '<a href="project/deleteProject.php?projectId='.$projectId.'&teamId='.$val["id_team"].'&userId='.$userId.'&userRole='.$userRole.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>';
            }else{
                $deleteButton = '';
            }

            echo '
                            <tr>
                                <td>#</td>
                                <td>
                                    <a>'.$val["nom_projet"].'</a>
                                </td>
                                <td>
                                    <div>
                                        '.$teamName.'
                                    </div>
                                </td>
                                <td>
                                    <div id="custom_progress_bar">
                                        <div id="bar" class="bar_class" style="width:'.$percentage.'"></div>
                                    </div>
                                    <br>
                                    <br>
                                </td>
                                <td>
                                    '.$button.'
                                </td>
                                <td>
                                    <a href="project.php?id='.$projectId.'" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                    <a href="modifyProject.php?id='.$projectId.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    '.$deleteButton.'
                                 </td>
                            </tr>
        
        ';
        }
    }
}

function rigthButton($pourcentage, $warning){

    if ($pourcentage == 100){
        return '<button type="button" class="btn btn-success btn-xs">Fini</button>';
    }elseif ($warning){
        return '<button type="button" class="btn btn-danger btn-xs">Probleme</button>';
    }else{
        return '<button type="button" class="btn btn-info btn-xs">En cours</button>';
    }

}

function checkProjectStatut($projectId){

    $db = dbConnect();
    $query = $db->prepare("SELECT project_statut FROM PROJETS WHERE id_projet = :id");
    $query->execute([
        "id"=>$projectId
    ]);

    $res=$query->fetch();

    return $res['project_statut'];

}


function isCreatorOfTeam($teamId, $userId){

    $db = dbConnect();
    $query = $db->prepare("SELECT id, createur FROM EQUIPES WHERE id = :id AND createur = :createur");
    $query->execute([
        "id"=>$teamId,
        "createur"=>$userId
    ]);

    $res=$query->fetch();
    return $res;

}

?>