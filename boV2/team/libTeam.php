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

        $gotUser = $query->fetch();

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
                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
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




?>