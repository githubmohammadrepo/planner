<?php

$names = ['a'=>'a','b','c','d'];

array_splice($names,1,1,[3=>'hhh']);

print_r($names);