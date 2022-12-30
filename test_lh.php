<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");

use App\Classes\Characters\Character;
use App\Classes\Gears\Gear;
use App\Classes\Specializations\Ninja;
use App\Classes\Specializations\CHaman;

$player = new Ninja("Henry");
$punchingBall = new Chaman("Sam");

$player->takesGear();
echo PHP_EOL;
$punchingBall->takesGear();
fight($player, $punchingBall);



