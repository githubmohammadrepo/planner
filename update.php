<?php
require_once('./vendor/autoload.php');
use Carbon\Carbon;
require_once ('./Database.php');
require_once ('./Task.php');

//get infomations
$id = $_POST['id'];
$title_id = $_POST['title_id'];
$read_time = $_POST['read_time'];

//execute operations
$db = new Databasep();
$db->Update($id,$title_id,$read_time);

