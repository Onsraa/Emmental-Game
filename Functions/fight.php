<?php

use App\Classes\Characters\Character;
use App\Classes\Mobs\Piggy;
use App\Classes\Mobs\Demon;
use App\Classes\Mobs\Goblin;
use App\Classes\Mobs\Dragon;
use App\Classes\Mobs\Specter;
use App\Classes\Mobs\DarkMage;

function fight(Character &$player1, Character &$player2): void
{

    cls();

    $player1->restore();
    $player2->restore();

    $player1->takesGear();
    $player2->takesGear();

    $round = 1;
    while ($player1->isAlive && $player2->isAlive) {

        echo PHP_EOL . "*****************************************************************************" . PHP_EOL;;

        echo " [ROUND : {$round}]" . PHP_EOL;
        if ($round % 2) {
            switch (fightAlgorithm($player1, $player2)) {
                case "hit":
                    $player1->hit($player2);
                    break;
                case "heal":
                    $player1->heal($player2);
                    break;
            }
        } else {
            switch (fightAlgorithm($player2, $player1)) {
                case "hit":
                    $player2->hit($player1);
                    break;
                case "heal":
                    $player2->heal($player1);
                    break;
            }
            $player2->currentMana+=50;
            $player1->currentMana+=50;
        }
        $round++;
    }
    echo PHP_EOL . "*****************************************************************************" . PHP_EOL;;
    echo PHP_EOL;
    if ($player1->isAlive) {
        echo "The {$player1} won ! Congratulations." . PHP_EOL;
    } else {
        echo "You got defeated by {$player2}, try next time." . PHP_EOL;
    }
    echo PHP_EOL;
}

function fightAlgorithm(Character $attacker, Character $target): string
{
    //function that will define what action the player should do to optimize his chance to win 
    if ($attacker->potentialDeath($target)) { // the attacker will check if he can kill him on that turn
        return "hit";
    } else if ($attacker->currentHealth <= $attacker->health * 0.6) {
        return "heal"; // if he can't kill the ennemy this turn, then he will try to heal (conditions to heal are in the heal() function, so if the player doesn't have enough mana or enough hp to survive, then he will hit)
    } else {
        return "hit";
    }
}


function mobGenerator(): ?Character
{

    $mobs = ["Piggy", "Demon", "Goblin", "Dragon", "Specter", "Dark mage"];

    cls();
    do {
        echo "Who do you want to fight ?" . PHP_EOL . PHP_EOL;

        foreach ($mobs as $key => $value) {
            $nb_mob = $key + 1;
            echo $nb_mob . " : " . $value . PHP_EOL;
        }

        echo "0 : Random mob" . PHP_EOL;
        echo "-1 : Hell no i'm out of here" . PHP_EOL . PHP_EOL;

        $answer = readline("Selection : ");
    } while ($answer < -1 && $answer > count($mobs));

    if($answer == -1){
        return null;
    }
    
    if ($answer == 0) {
        $answer = (int) rand(1, count($mobs));
    }

    switch ($answer) {
        case 1:
            return new Piggy;
        case 2:
            return new Demon;
        case 3:
            return new Goblin;
        case 4:
            return new Dragon;
        case 5:
            return new Specter;
        case 6:
            return new DarkMage;
    }
}
