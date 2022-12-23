<?php

namespace App\Classes\Characters;

use App\Classes\Elements\Element;
use App\Classes\Gears\Gear;
use App\Classes\Spells\Spell;

abstract class Character
{

    private bool $isAlive = true; // primary status to verify if the character is alive or not

    function __construct(
        protected string $className, // basically the specialization name of the character
        protected Element $element, // the element which will define who he is weak against
        protected float $health,
        protected float $mana,
        protected float $physicalStrenght, // basic stats without weapons and stuffs
        protected float $magicalStrenght,
        protected float $physicalDefense,
        protected float $magicalDefense,
        protected array $level = ["level" => (int)1, "exp" => (int)0, "expNeededToLevelUp" => (int)50],
        protected ?Gear $gear = null,
        protected ?Spell $offensiveSpell = null,
        protected ?Spell $defenseSpell = null,
        protected ?Spell $healSpell = null,
    ) {
    }

    protected function damageDeals(Character $target): array
    { // function to calculate the damage before the damageTanked()
        $damageDeals = ["physicalDamage" => $this->physicalStrenght, "magicalDamage" => $this->magicalStrenght];
        return $damageDeals;
    }

    protected function damageTanked(Character $target, float $damage): float
    { // function to calculate the final damage before the getHit()

        return 0.1;
    }

    public function getHit(Character $target, float $damage): void
    {
        // final damage done to the opponent
        $target->health -= $damage;
    }

    public function state(Character $target): bool
    {
        // change the value of isAlive depends on the health state
        if ($target->health <= 0) {
            $target->isAlive = false;
        }
        return $target->isAlive;
    }
}
