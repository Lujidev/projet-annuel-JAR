<?php

function getMember($teamId){
    $db = dbConnect();

    $query = $db->prepare("SELECT id_user FROM TEAMMATES WHERE id_team=:id_team AND is_accepted = :is_accepted");
    $query->execute([
        "id_team"=>$teamId,
        "is_accepted"=>1
    ]);

    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    $dataArray = [];

    foreach ($res as $value){

        $query = $db->prepare("SELECT * FROM UTILISATEURS WHERE id_utilisateur=:id_utilisateur");
        $query->execute([
            "id_utilisateur"=>$value["id_user"]
        ]);

        $gotUser = $query->fetch(PDO::FETCH_ASSOC);

        array_push($dataArray, $gotUser);
    }

    return $dataArray;

}

function displayTeams($data, $userId){


    foreach ($data as $value){

        $members = getMember($value['id']);
        $memberLi = "";

        foreach ($members as $val){
            $memberLi .= '
                      <li>
                         <img src="upload/user/'.$val["avatar"].'" class="avatar" alt="Avatar">
                      </li>
            ';
        }


        echo '
                            <tr>
                                <td>#</td>
                                <td>
                                    <a>'.$value["nom_equipe"].'</a>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        '.$memberLi.'
                                    </ul>
                                </td>
                                <td>
                                    <a href="team.php?id='.$value["id"].'" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Voir </a>
                                    <a href="modifyTeam.php?id='.$value["id"].'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="team/deleteTeam?id='.$value["id"].'&userId='.$userId.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                            </tr>
        
        ';
    }


}

function getTeam($teamId){

    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM equipes WHERE id=:id");
    $query->execute([
        "id"=>$teamId
    ]);

    $res = $query->fetch();

    return $res;
}

function getTeamInfoWithToken($token){

    $db = dbConnect();

    $query = $db->prepare("SELECT id_team FROM TEAMMATES WHERE is_accepted=:is_accepted");
    $query->execute([
        "is_accepted"=>$token
    ]);

    $res = $query->fetch();

    if (!empty($res)){

        $query = $db->prepare("SELECT nom_equipe FROM EQUIPES WHERE id=:id");
        $query->execute([
            "id"=>$res['id_team']
        ]);

        $team = $query->fetch();

        return $team;

    }else{
        return "";
    }



}

function displayTeamMembers($teamId, $userId, $userRole){


    $isCreator = isCreatorOfTeam($teamId, $userId);

    $members = getMember($teamId);

    //print_r($members);

    foreach ($members as $value){
        $userSelected = $value['id_utilisateur'];
        if (!empty($isCreator) || $userRole==3){
            $button ="<a href='team/makeTeamCreator.php?upgradeId=".$userSelected."&teamId=".$teamId."'>Faire de lui le capitaine</a>";
        }else{
            $button = "";
        }


        echo "<tr>
            <td>
                <input type='checkbox' id='check-all' class='flat' name='delete[]' value=".$value['id_utilisateur'].">
            </td>
            <td>".$value['id_utilisateur']."</td>
            <td>".$value['pseudo']."</td>
            <td>".$value['email']."</td>
            <td>".$button."</td>
            </tr>";



    }

}


function displayTeamInvit($userId){


        $db = dbConnect();

        $query = $db->prepare("SELECT * FROM TEAMMATES WHERE id_user=:id_user AND is_accepted != :is_accepted");
        $query->execute([
            "id_user"=>$userId,
            "is_accepted"=>1
        ]);

        $allInvit = $query->fetchAll(PDO::FETCH_ASSOC);
        $invits = "";

    foreach ($allInvit as $value){

        $teamName = getTeamName($value["id_team"]);
        $token = "'".$value['is_accepted']."'";


        $invits .='
        
                      <tr>
                          <td>#</td>
                                <td>
                                    <a>'.$teamName.'</a>
                                </td>
                                <td>
                                <button type="button" class="btn btn-info btn-lg" onclick="acceptInvit('.$token.')">Accepter</button>
                                <button type="button" class="btn btn-danger btn-lg" onclick="declineInvit('.$token.')">Refuser</button>
                                </td>
                            </tr>
        
        ';
    }
    if (!empty($allInvit)){

        echo '
        
        <div class="row">
                <div class="col-md-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>vos équipes:</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 20%">Nom de la Team</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                '.$invits.'
                                </tbody>
                            </table>
    
    
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
}





?>