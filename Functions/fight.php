<?php

use App\Classes\Characters\Character;

function fight(Character $player1, Character $player2): void
{

    $round = 0;

    while ($player1->isAlive && $player2->isAlive) {

        echo PHP_EOL . "******************************************" . PHP_EOL;;

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
        }

        $round++;
    }

    echo PHP_EOL;
    if($player1->isAlive){
        echo "The {$player1} won ! Congratulations.";
    }else{
        echo "The {$player2} won ! Congratulations.";
    }
    echo PHP_EOL;

}

function fightAlgorithm(Character $attacker, Character $target): string
{
    //function that will define what action the player should do to optimize his chance to win 
    if ($attacker->potentialDeath($target)) { // the attacker will check if he can kill him on that turn
        return "hit";
    } else if ($attacker->currentHealth <= $attacker->health * 0.6){
        return "heal"; // if he can't kill the ennemy this turn, then he will try to heal (conditions to heal are in the heal() function, so if the player doesn't have enough mana or enough hp to survive, then he will hit)
    }else{
        return "hit";
    }
}

function generateRandomOpponent(): Character{

    array mobs = ["Piggy", "Demon", "Goblin", "Dragon", "Specter", "Dark mage"];

    
}
