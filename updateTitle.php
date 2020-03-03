<?php

require_once('./Database.php');

//get infomations
$id = $_POST['id'];
$title = $_POST['title'];

//execute operations
$db = new Databasep();
$db->updateTitle($id,$title);