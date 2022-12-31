<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");

use App\Classes\Characters\Character;
use App\Classes\Gears\Gear;
use App\Classes\Specializations\Ninja;
use App\Classes\Specializations\CHaman;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;

$test = new Draconist("Bob");
$tul = new FlowerFairy("Elsa");
$player = new Ninja("Henry");
$punchingBall = new Chaman("Sam");

fight($player, $punchingBall);



