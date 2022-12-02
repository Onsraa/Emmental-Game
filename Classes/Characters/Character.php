<?php

namespace App\Classes\Characters;

use App\Classes\Gears\Gear;
use App\Classes\Spells\Spell;

abstract class Character
{

    private bool $isAlive = true; // primary status to verify if the character is alive or not

    function __construct(
        protected string $className, // basically the specialization name of the character
        protected string $element, // the element which will define who he is weak against
        protected float $health,
        protected float $mana,
        protected float $physicalStrenght, // basic stats without weapons and stuffs
        protected float $magicalStrenght,
        protected float $physicalDefense,
        protected float $magicalDefense,
        protected array $level = ["level" => 1, "exp" => 0],
        protected ?Gear $gear = null,
        protected ?Spell $offensiveSpell = null,
        protected ?Spell $defenseSpell = null,
        protected ?Spell $healSpell = null,
    ) {
    }

    protected function damageDeals(Character $character): float
    { // function to calculate the damage before the damageTanked()
        return 0.1;
    }

    protected function damageTanked(Character $victim, float $damage): float
    { // function to calculate the final damage before the getHit()

        return 0.1;
    }

    public function getHit(Character $victim, float $damage): void
    {
        // final damage done to the opponent
        $victim->health -= $damage;
    }

    public function state(Character $victim): bool
    {
        // change the value of isAlive depends on the health state
        if($victim->health <= 0){
            $victim->isAlive = false;
        }
        return $victim->isAlive;
    }
}
