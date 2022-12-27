<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");

use App\Classes\Specializations\Chaman;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;

$player1 = new Draconist();
$player2 = new Chaman();
$player3 = new FlowerFairy();

$classes = ["Draconist", "Chaman", "FlowerFairy"];
$nbClasses = count($classes);

echo PHP_EOL;
$name = readline("What is your name ? ") . PHP_EOL;
echo "Welcome {$name}";

echo PHP_EOL;
echo "Choose your class : [";
foreach($classes as $key => $value){
    echo $value ;
    echo ($key != $nbClasses - 1) ? ", " : "]";
}
echo PHP_EOL;
$choice = readline();
echo PHP_EOL;

echo "You're now a {$choice} !";


