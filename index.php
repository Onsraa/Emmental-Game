<?php

require_once("./autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");
require_once("./Functions/classes.php");
require_once("./Functions/spell.php");

function cls() //clear console function                                                                                                           
{
    print("\033[2J\033[;H");
}

$player_characters = []; // each class created is added here
cls();
echo "Welcome to our game" . PHP_EOL;

echo PHP_EOL . "What is your name ?" . PHP_EOL . PHP_EOL;

$nickname = readline("Your name : ") . PHP_EOL;

cls();

echo PHP_EOL . "Nice to meet you {$nickname}" . PHP_EOL;


if (empty($player_characters)) {
    echo "You currently don't have any character. Would you like one ?" . PHP_EOL . PHP_EOL;
    do {
        $answer = readline("(y)es or (n)o : ");
    } while ($answer != 'Y' && $answer != 'y' && $answer != 'N' && $answer != 'n');
    cls();
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
    $current_character = $player_characters[0];

    cls();

    echo PHP_EOL . "Ok so now, let's start the adventure. What do you want to do ?" . PHP_EOL . PHP_EOL;

    while (1) {
        echo "1. Fight" . PHP_EOL;
        echo "2. Show stats" . PHP_EOL;
        echo "3. Choose spells" . PHP_EOL;
        echo "4. Check characters" . PHP_EOL;
        echo "5. Leave" . PHP_EOL . PHP_EOL;

        $answer = readline("Selection : ");

        cls();

        switch ($answer) {
            case 1:
                $opponent = mobGenerator();

                if ($opponent) {
                    fight($current_character, $opponent);
                }

                break;
            case 2:
                $current_character->showSpec();
                break;
            case 3:
                chooseAnotherSpell($current_character);
                break;
            case 4:
                chooseAnotherClass($player_characters, $nickname, $current_character);
                break;
            case 5:
                echo PHP_EOL . "Are you sure ?" . PHP_EOL;
                do {
                    $answer = readline("(y)es or (n)o : ");
                } while ($answer != 'Y' && $answer != 'y' && $answer != 'N' && $answer != 'n');
                cls();
                switch (strtoupper($answer)) {
                    case 'Y':
                        echo PHP_EOL . "Ok, bye loser.." . PHP_EOL;
                        exit;
                    case 'N':
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
    }
}
