<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");

use App\Classes\Characters\Character;
use App\Classes\Gears\Gear;
use App\Classes\Specializations\Draconist;
use App\Classes\Gears\Weapons\MagicalWeapons\WandOfCallipso;

$player = new Draconist("Henry");

$punchingBall = new Draconist("Sam");

$player->takesGear();
echo PHP_EOL;
$player->showGear();

