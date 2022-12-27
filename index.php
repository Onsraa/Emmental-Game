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

system('cls');

fight($player1, $player3);
