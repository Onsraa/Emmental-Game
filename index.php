<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");
require_once ("./Functions/101Functions.php");

use App\Classes\Specializations\Chaman;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;
use App\Classes\Spells\Defensive;
use App\Classes\Spells\Offensive\Offensive;

$defense1 = new Defensive\Defensive("Ultra Mega Defense", "The strongest Defense", 20, 0);
$defense2 = new Defensive\Defensive("Weakest Defense", "The Weakest Defense", 1, 100);
$defense = array($defense1,$defense2);
$attack1 = new Offensive("Ultra Mega Attack","The Strongest attack",20,0);
$attack2 = new Offensive("Weakest Attack","The Weakest attack",1,100);
$attack = array($attack1,$attack2);
$player1 = new Draconist();
$player2 = new Chaman();
$player3 = new FlowerFairy();
echo "Welcome to our game".PHP_EOL;
while (1){
echo "1.Select new character.".PHP_EOL;
echo "2.Continue.".PHP_EOL;
echo "3.Class information".PHP_EOL;
echo "0.Quit".PHP_EOL;
$select_menu= readline("Selection: ");
    if (in_range($select_menu,0,3)) {
        switch ($select_menu) {
            case 1:
                echo "select a class:" . PHP_EOL;
                echo "1.Draconist" . PHP_EOL;
                echo "2.Chaman" . PHP_EOL;
                echo "3.FlowerFairy" . PHP_EOL;
                echo "0.Random" . PHP_EOL;
                $select_class = readline("Selection: ");
                if(in_range($select_class,0,3)){
                    if ($select_class == 0){
                        $select_class = rand(1,3);
                    }
                    switch($select_class){
                        case 1:
                            $user_character = new Draconist();
                            break;
                        case 2:
                            $user_character = new Chaman();
                            break;
                        case 3:
                            $user_character = new FlowerFairy();
                            break;
                    }
                }
                break;
            case 2:
                while(1){
                    echo "1.Select new spell.".PHP_EOL;
                    echo "2.Select new equipment.".PHP_EOL;
                    echo "3.Class information".PHP_EOL;
                    echo "4.Fight".PHP_EOL;
                    echo "0.Back".PHP_EOL;
                    $select_equipment= readline("Selection: ");
                    if (in_range($select_equipment,0,4)) {
                        switch ($select_menu) {
                            case 1:
                                echo "1.Select attack spell.".PHP_EOL;
                                echo "2.Select defend spell.".PHP_EOL;
                                echo "3.Select heal spell.".PHP_EOL;
                                echo "0.Back.".PHP_EOL;
                                $select_spell = readline("Selection: ");
                                if (in_range($select_spell,0,4)){
                                    switch($select_spell){
                                        case 1:
                                            echo "Attack spell: ".PHP_EOL;
                                            $count = 0;
                                            foreach ($attack as &$attack_spell){
                                                echo $count.": Name: ".$attack_spell->spellName." | Mana cost: ".$attack_spell->cost." | Defense: ".$attack_spell->value;
                                                $count++;
                                            }
                                            $select_attack_spell = readline("Selection: ");
                                            if (in_range($select_attack_spell,0,$count)){
                                                $user_character->setAttackSpel($attack[$select_attack_spell]);
                                            }
                                            break;
                                        case 2:
                                            echo "Defense spell: ".PHP_EOL;
                                            $count = 0;
                                        foreach ($defense as &$defense_spell){
                                            echo $count.": Name: ".$defense_spell->spellName." | Mana cost: ".$defense_spell->cost." | Defense: ".$defense_spell->value;
                                            $count++;
                                        }
                                        $select_defense_spell = readline("Selection: ");
                                        if (in_range($select_defense_spell,0,$count)){
                                            $user_character->setDefenseSpel($defense[$select_defense_spell]);
                                        }
                                        break;
                                        case 3:
                                            echo "Heal spell: ".PHP_EOL;
                                            $count = 0;
                                            foreach ($heal as &$heal_spell){
                                                echo $count.": Name: ".$heal_spell->spellName." | Mana cost: ".$heal_spell->cost." | Defense: ".$heal_spell->value;
                                                $count++;
                                            }
                                            $select_heal_spell = readline("Selection: ");
                                            if (in_range($select_heal_spell,0,$count)){
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
                                fight($user_character,$player2);
                                break;

                            case 0:
                                break;
                        }
                    }
                }
                break;
            case 3:
                if (isset($user_character)){
                    $user_character->showInformation();
                } else {
                    echo "You don't have any character".PHP_EOL;
                }
                break;
            case 0:
                return;

        }
    }
}
