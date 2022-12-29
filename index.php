<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");
require_once("./Functions/classes.php");

use App\Classes\Specializations\Chaman;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;

$player_characters = []; // each class created is added here

echo "Welcome to our game" . PHP_EOL;

echo PHP_EOL . "What is your name ?" . PHP_EOL;

$nickname = readline("Your name : ") . PHP_EOL;

echo PHP_EOL . "Nice to meet you {$nickname}" . PHP_EOL;


if (empty($player_characters)) {
    echo "You currently don't have any character. Would you like one ?" . PHP_EOL;
    echo "(Y)es or (N)o" . PHP_EOL;
    do {
        $answer = readline("Answer : ");
    } while ($answer != 'Y' && $answer != 'y' && $answer != 'N' && $answer != 'n');
    switch (strtoupper($answer)) {
        case 'Y':
            echo PHP_EOL . "Cool ! Let's begin." . PHP_EOL;
            break;
        case 'N':
            $screamedNickname = strtoupper($nickname);
            echo PHP_EOL . "Well.. then bye {$screamedNickname}." . PHP_EOL;
            exit;
        default:
            break;
    }
    echo PHP_EOL;
    array_push($player_characters, addClass($nickname));
}

// TEDDY STOPS HERE
