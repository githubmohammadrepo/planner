<?php

require_once('./vendor/autoload.php');
use Carbon\Carbon;
require_once ('./Database.php');
require_once ('./Task.php');

$db = new Databasep();



//get infomations
$newHour = $_POST['newHour'] ?? null;

if ($newHour !=null) {
    //insert newHoure 
    if(checkRowExist($db,(Carbon::now('Asia/Tehran')))){
        //exist dont doublicate it
    }else{
        //if row for today is exsit prevent create new one
        foreach ($_POST['ids'] as $key => $value) {
            $db->Insert($value, 0);
        }  
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


// functions

//check if row exist in the tasksTitle table
function checkRowExist($db,$loop){
    
    $dloop = $loop->copy()->subDays(1);
    $dloop->hour = 23;
    $dloop->minute = 59;
    $dloop->second = 1;

    $aloop = $loop->copy()->addDays(1);
    $aloop->hour = 00;
    $aloop->minute = 00;
    $aloop->second = 1;
    return count($db->Read($dloop,$aloop));
}

?>