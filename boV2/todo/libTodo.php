<?php

function addTodoBdd($team, $content){

    $db = dbConnect();

    $query = $db->prepare("INSERT INTO TODO(content, team) VALUES(:content, :team)");

    $query->execute([
        "content"=>$content,
        "team"=>$team
    ]);

}

function doneTodoBdd($id){

    $db = dbConnect();

    $query = $db->prepare("UPDATE TODO SET is_done = '1' WHERE id_todo = :id");

    $query->execute([
        "id"=>$id
    ]);

}

function displayTodo($team){

    $db = dbConnect();
    $query = $db->prepare("SELECT * FROM TODO WHERE team=:team && is_done != '1'");
    $query->execute([
        "team"=>$team
    ]);
    $project = $query->fetchAll();

    foreach ($project as $value){
        $content = $value["content"];
        $id = $value['id_todo'];

        echo '<li title="'.$id.'" onclick="finishTodo('.$id.')" id="todo_'.$id.'">'.$content.'</li>';

    }
}


function finishedTodo($team){

    $db = dbConnect();
    $query = $db->prepare("SELECT * FROM TODO WHERE team=:team && is_done != '0'");
    $query->execute([
        "team"=>$team
    ]);
    $project = $query->fetchAll();

    foreach ($project as $value){
        $content = $value["content"];
        $id = $value['id_todo'];

        echo '<li title="'.$id.'" onclick="removeTodo('.$id.')" id="todo_'.$id.'">'.$content.'</li>';

    }
}

function removeTodo($id){

    $db = dbConnect();
    $query = $db->prepare("DELETE FROM TODO WHERE id_todo = :id");
    $query->execute([
        "id"=>$id
    ]);

}

function calculPercentage($team){

    $db = dbConnect();
    $query = $db->prepare("SELECT COUNT(*) FROM TODO WHERE team = :team");
    $query->execute([
        "team"=>$team
    ]);
    $all = $query->fetch();

    $query2 = $db->prepare("SELECT COUNT(*) FROM TODO WHERE team = :team AND is_done = :is_done");
    $query2->execute([
        "team"=>$team,
        "is_done"=>1
    ]);
    $is_done = $query2->fetch();

    if ($all[0]!= 0){
        $percent = $is_done[0]/$all[0]*100;
    }else{
        $percent = 0;
    }


    return intval($percent);
}


function checkStatut($id){

    $db = dbConnect();
    $query = $db->prepare("SELECT project_statut FROM PROJETS WHERE id_projet = :id");
    $query->execute([
        "id"=>$id
    ]);

    $res=$query->fetch();

    if ($res['project_statut']){
        return "Annuler la demande";
    }else{
        return "Demander de l'aide";
    }

}




?>

