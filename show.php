<?php
header("Content-Type: application/json");
require_once ('./Database.php');

print_r(json_encode((new Databasep())->showTitles()));