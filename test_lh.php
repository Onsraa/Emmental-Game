<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");

use App\Classes\Characters\Character;
use App\Classes\Gears\Gear;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;
use App\Classes\Gears\Weapons\MagicalWeapons\WandOfCallipso;

$player = new Draconist("Henry");

$punchingBall = new FlowerFairy("Sam");

//error if one doesn't have smth in gear, fix incoming.
$player->takesGear();
echo PHP_EOL;
$punchingBall->takesGear();
fight($player, $punchingBall);



