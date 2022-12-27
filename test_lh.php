<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");

use App\Classes\Characters\Character;
use App\Classes\Gears\Gear;
use App\Classes\Specialisations\Draconist;
use App\Classes\Gears\Weapons\MagicalWeapons\WandOfCallipso;

$player = new Draconist();

$punchingBall = new Draconist();

$player->takesGear();

