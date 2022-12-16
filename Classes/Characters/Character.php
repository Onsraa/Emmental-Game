<?php

namespace App\Classes\Characters;

use App\Classes\Elements\Element;
use App\Classes\Gears\Gear;
use App\Classes\Spells\Spell;

abstract class Character
{

    private bool $isAlive = true; // primary status to verify if the character is alive or not
    public Element $myElement;

    function __construct(
        protected string $className, // basically the specialization name of the character
        protected string $element, // the element which will define who he is weak against
        protected float $health,
        protected float $mana,
        protected float $physicalStrength, // basic stats without weapons and stuffs
        protected float $magicalStrength,
        protected float $physicalDefense,
        protected float $magicalDefense,
        protected array $level = ["level" => (int)1, "exp" => (int)0, "expNeededToLevelUp" => (int)50],
        protected ?Gear $gear = null,
        protected ?Spell $offensiveSpell = null,
        protected ?Spell $defenseSpell = null,
        protected ?Spell $healSpell = null,
    ) {
        $this->myElement = new Element($element);
    }

    protected function damageDeals(): array
    { // function to calculate the damage before the damageTanked()
        return ["physicalDamage" => $this->physicalStrength, "magicalDamage" => $this->magicalStrength];
    }

    protected function damageTanked(Character $target, array $damage): float
    { // function to calculate the final damage before the getHit()

        return 0.1;
    }

    public function hit(Character $target): void
    {
        $damage = $target->damageTanked($target, $this->damageDeals($target));
        // final damage done to the opponent
        $target->health -= $damage;
    }

    public function state(): bool
    {
        // change the value of isAlive depends on the health state
        if ($this->health <= 0) {
            $this->isAlive = false;
        }
        return $this->isAlive;
    }

    function __toString()
    {
        return $this->className;
    }
}
