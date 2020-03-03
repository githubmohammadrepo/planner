<?php


require_once('./Database.php');

//get infomations
$id = $_POST['id'];


//execute operations
$db = new Databasep();

//if id ==0 insert

$db->Delete($id);
    

