<?php

require_once('./Database.php');
$db = new Databasep();

//get infomations
$newHour = $_POST['newHour'] ?? null;

if ($newHour !=null) {
    foreach ($_POST['ids'] as $key => $value) {
        $db->Insert($value, 0);
    }    
}
else {

//normall insert and update
    $id = $_POST['id'];
    $title_id = $_POST['title_id'];
    $read_time = $_POST['read_time'];

    //execute operations

    //if id ==0 insert
    if ($id ==0) {
        $db->Insert($title_id, $read_time);
    } else {
  
    //else update
        $db->Update($id, $title_id, $read_time);
    }
}
