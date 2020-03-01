<?php
 require_once('./vendor/autoload.php');
 
 require_once('./Database.php');
 
 use Carbon\Carbon;
 
 class Task extends Carbon
 {

     public function show($date)
     {
             
        // //first date
        //  $now = Carbon::create($date);

        //  echo "$now <br>";

        //  $d1 = $now->copy()->addDays(1);
        //  echo "$d1 <br>";

        //  $to = Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-5 3:30:34');
        //  $from = Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-6 9:30:34');
        //  $diff_in_days = $now->diffInDays($d1);
        //  print_r($diff_in_days); // Output: 1



     }

     public function result($db,$c){
        
     }
 }
