<?php

require_once('./Database.php');

//get infomations
$id = $_POST['id'];

//execute operations
$db = new Databasep();
$db->removeTitle($id);