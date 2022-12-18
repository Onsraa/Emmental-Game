<?php

use App\Classes\Characters\Character;

function fight(Character $player1, Character $player2): void
{

    $round = 0;

    while ($player1->isAlive && $player2->isAlive) {

        if ($round % 2) {
            switch (fightAlgorithm($player1, $player2)) {
                case "hit":
                    $player1->hit($player2);
                case "heal":
                    $player1->heal($player2);
            }
        } else {
            switch (fightAlgorithm($player2, $player1)) {
                case "hit":
                    $player2->hit($player1);
                case "heal":
                    $player2->heal($player1);
            }
        }
    }
}

function fightAlgorithm(Character $attacker, Character $target): string
{
    //function that will define what action the player should do to optimize his chance to win 

    if ($target->getDamageTanked($attacker) >= $target->health) { // the attacker will check if he can kill him on that turn
        return "hit";
    } else {
        return "heal"; // if he can't kill for then he will try to heal (conditions to heal are in the heal() function, so if the player doesn't have enough mana or enough hp to survive, then he will hit)
    }
}
