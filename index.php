<?php
// header("Content-Type: application/json");

require_once('./vendor/autoload.php');
use Carbon\Carbon;
require_once ('./Database.php');
require_once ('./Task.php');

echo '<pre>';

$values = array(
    'title_id' => 2,
     'read_time' => '3h', 
);
// (new Databasep())->Insert($values);
// print_r(json_encode((new Databasep())->Read()));





$db = new Databasep();
$first = $db->first();
$last = $db->last();

$cfirst = Carbon::create($first);
$clast = Carbon::create($last);
$diff = ($clast->dayOfYear() - $cfirst->dayOfYear()); 
$loop = $cfirst;


$allInfo = [];
for($i=0;$i<=$diff; $i++){
    
    $dloop = $loop->copy()->subDays(1);
    $dloop->hour = 23;
    $dloop->minute = 59;
    $dloop->second = 1;
    $aloop = $loop->copy()->addDays(1);
    $aloop->hour = 00;
    $aloop->minute = 00;
    $aloop->second = 1;;

   array_push($allInfo,($db->Read($dloop, $aloop)));
    
    $loop = $loop->copy()->addDays(1);
}


print_r(($allInfo));
