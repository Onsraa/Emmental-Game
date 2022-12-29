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

while (1) {
    if (empty($player_characters)) {
        echo "You currently don't have any character. Would you like one ?" . PHP_EOL;
        echo "(Y)es or (N)o" . PHP_EOL;
        do {
            $answer = readline("Answer : ");
        } while ($answer != 'Y' && $answer != 'y' && $answer != 'N' && $answer != 'n');

        switch ($answer) {
            case 'Y' || 'y':
                echo PHP_EOL . "Cool ! Let's begin." . PHP_EOL;
                break;
            case 'N' || 'n':
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
    exit;

    echo "1. Select new character." . PHP_EOL;
    echo "2. Continue." . PHP_EOL;
    echo "3. Class information" . PHP_EOL;
    echo "0. Quit" . PHP_EOL;
    do {
        $select_menu = readline("Selection: ");
    } while ($select_menu < 0 || $select_menu > 3);

    switch ($select_menu) {
        case 1:
            echo "Select a class :" . PHP_EOL;

            foreach ($classes as $key => $value) {
                $character_nb = $key + 1;
                echo "{$character_nb} : {$value}" . PHP_EOL;
            }
            echo "0 : random" . PHP_EOL;

            do {
                $select_class = readline("Selection: ");
            } while ($select_class < 0 || $select_class > $nbClasses);

            if ($select_class == 0) {
                $select_class = (int)rand(1, $nbClasses);
            }

            foreach ($classes as $key => $value) {
                $character_nb = $key + 1;
                if ($select_class == $character_nb) {
                    $user_character = giveClass($nickname, $value);
                }
            }
            break;

        case 2:
            while (1) {
                echo "1.Select new spell." . PHP_EOL;
                echo "2.Select new equipment." . PHP_EOL;
                echo "3.Class information" . PHP_EOL;
                echo "4.Fight" . PHP_EOL;
                echo "0.Back" . PHP_EOL;
                $select_equipment = readline("Selection: ");
                if (in_range($select_equipment, 0, 4)) {
                    switch ($select_menu) {
                        case 1:
                            echo "1.Select attack spell." . PHP_EOL;
                            echo "2.Select defend spell." . PHP_EOL;
                            echo "3.Select heal spell." . PHP_EOL;
                            echo "0.Back." . PHP_EOL;
                            $select_spell = readline("Selection: ");
                            if (in_range($select_spell, 0, 4)) {
                                switch ($select_spell) {
                                    case 1:
                                        echo "Attack spell: " . PHP_EOL;
                                        $count = 0;
                                        foreach ($attack as &$attack_spell) {
                                            echo $count . ": Name: " . $attack_spell->spellName . " | Mana cost: " . $attack_spell->cost . " | Defense: " . $attack_spell->value;
                                            $count++;
                                        }
                                        $select_attack_spell = readline("Selection: ");
                                        if (in_range($select_attack_spell, 0, $count)) {
                                            $user_character->setAttackSpel($attack[$select_attack_spell]);
                                        }
                                        break;
                                    case 2:
                                        echo "Defense spell: " . PHP_EOL;
                                        $count = 0;
                                        foreach ($defense as &$defense_spell) {
                                            echo $count . ": Name: " . $defense_spell->spellName . " | Mana cost: " . $defense_spell->cost . " | Defense: " . $defense_spell->value;
                                            $count++;
                                        }
                                        $select_defense_spell = readline("Selection: ");
                                        if (in_range($select_defense_spell, 0, $count)) {
                                            $user_character->setDefenseSpel($defense[$select_defense_spell]);
                                        }
                                        break;
                                    case 3:
                                        echo "Heal spell: " . PHP_EOL;
                                        $count = 0;
                                        foreach ($heal as &$heal_spell) {
                                            echo $count . ": Name: " . $heal_spell->spellName . " | Mana cost: " . $heal_spell->cost . " | Defense: " . $heal_spell->value;
                                            $count++;
                                        }
                                        $select_heal_spell = readline("Selection: ");
                                        if (in_range($select_heal_spell, 0, $count)) {
                                            $user_character->setHealSpel($heal[$select_heal_spell]);
                                        }
                                        break;
                                    case 0:
                                        break;
                                }
                            }
                            break;
                        case 2:
                            echo "Equipment";
                            break;
                        case 3:
                            $user_character->showInformation();
                            break;
                        case 4:
                            fight($user_character, $player2);
                            break;

                        case 0:
                            break;
                    }
                }
            }
            break;
        case 3:
            if (isset($user_character)) {
                $user_character->showInformation();
            } else {
                echo "You don't have any character" . PHP_EOL;
            }
            break;
        case 0:
            return;
    }
}
