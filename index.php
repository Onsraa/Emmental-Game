<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");

use App\Classes\Specialisations\Chaman;
use App\Classes\Specialisations\Draconist;

$player1 = new Draconist();
$player2 = new Chaman();

fight($player1, $player2);