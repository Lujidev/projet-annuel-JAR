<?php

function getUserTeam($userId){

    $db = dbConnect();

    $query = $db->prepare(
        "SELECT id_team FROM TEAMMATES WHERE id_user = :id_user"
    );

    $query->execute([
        "id_user"=>$userId
    ]);

    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    return $res;
}

function getTeamInfo($teamId){

    $db = dbConnect();

    $query = $db->prepare(
        "SELECT nom_equipe FROM EQUIPES WHERE id = :id"
    );

    $query->execute([
        "id"=>$teamId
    ]);
    $res = $query->fetch(PDO::FETCH_ASSOC);
    return $res;
}

function displayTeamChatBox($userId){

    $teams = getUserTeam($userId);

    foreach ($teams as $value){

        $teamName = getTeamInfo($value["id_team"]);

        $data = [
            $value["id_team"],
            $userId,
            $teamName["nom_equipe"]
        ];
        $notifId = "notif_".$value["id_team"];

        $dataInsert = "'".implode("','", $data)."'";

        $data2 = [
            $value["id_team"],
            $userId
        ];

        $dataInsertNotif = "'".implode("','", $data2)."'";


        echo '
                                         <li class="clearfix" onclick="openChatBox('.$dataInsert.')">
                                            <div class="chat-body clearfix" onclick="checkedNotif('.$dataInsertNotif.')">
                                                <div class="header_sec">
                                                    <strong class="primary-font">'.$teamName["nom_equipe"].'</strong>
                                                    <div class="badge pull-right" id="'.$notifId.'"></div>
                                                </div>
                                            </div>
                                        </li>

        ';

    }

}


function getNbNotif($user,$team){

    $db = dbConnect();

    $query = $db->prepare(
        "SELECT old_nb, new_nb FROM CHATNOTIF WHERE id_user = :id_user AND id_team = :id_team"
    );

    $query->execute([
        "id_user"=>$user,
        "id_team"=>$team
    ]);

    $res = $query->fetch(PDO::FETCH_ASSOC);

    $nb_notif = $res['new_nb'] - $res['old_nb'];

    return $nb_notif;


}

?>


