<?php

require_once('./Database.php');

//get infomations
$title = $_POST['title'];

//execute operations
$db = new Databasep();
$db->saveTitle($title);