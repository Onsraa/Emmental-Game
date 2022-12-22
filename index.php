<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");

use App\Classes\Specialisations\Chaman;
use App\Classes\Specialisations\Draconist;
use App\Classes\Specialisations\FlowerFairy;

$player1 = new Draconist();
$player2 = new Chaman();
$player3 = new FlowerFairy();

fight($player1, $player3);