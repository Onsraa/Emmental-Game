<?php

namespace App\Classes\Characters;

use App\Classes\Elements\Element;
use App\Classes\Gears\Gear;
use App\Classes\Spells\Spell;

abstract class Character
{

    private bool $isAlive = true; // primary status to verify if the character is alive or not
    public Element $myElement; // element declared so it can be created as a new class in the construct function 
    protected float $currentHealth;   // dynamic health points
    function __construct(
        protected string $className,       // basically the specialization name of the character
        protected string $element,         // the element which will define who he is weak against
        protected float $health,           // total fixed health points
        protected float $mana,
        protected float $physicalStrength, // basic stats without weapons and stuffs
        protected float $magicalStrength,
        protected float $physicalDefense,
        protected float $magicalDefense,
        protected array $level = ["level" => (int)1, "exp" => (int)0, "expNeededToLevelUp" => (int)50], //the higher the level, the higher the stats will be
        protected ?Gear $gear = null, //gear that contains the weapon and the armor
        protected ?Spell $offensiveSpell = null,
        protected ?Spell $defenseSpell = null,
        protected ?Spell $healSpell = null,
    ) {
        $this->myElement = new Element($element);
        $this->currentHealth = $health;
    }

    protected function damageDeals(): array
    { // function to calculate the damage before the damageTanked()

        if ($this->mana >= $this->offensiveSpell->cost) {
            return ["physicalDamage" => $this->physicalStrength * $this->offensiveSpell->value, "magicalDamage" => $this->magicalStrength * $this->offensiveSpell->value]; // |||TO DO ||| do variable that checks the type of the spell
        }

        return ["physicalDamage" => $this->physicalStrength, "magicalDamage" => $this->magicalStrength];
    }

    protected function damageTanked(Character $attacker): array
    { // function to calculate the final damage before the hit()

        $damage = $attacker->damageDeals();
        $finalDamage = ["physicalDamage" => $damage["physicalDamage"] - $this->physicalDefense, "magicalDamage" => $damage["magicalDamage"] - $this->magicalDefense];

        switch ($attacker->myElement->compatibility($this->myElement)) {
            case "efficient":
                foreach ($finalDamage as $value) {
                    $value *= 1.5;
                }
            case "ineffective":
                foreach ($finalDamage as $value) {
                    $value *= 0.5;
                }
            default:
                break;
        }

        if ($this->currentHealth * 0.3 <= $finalDamage && $this->defenseSpell->cost <= $this->mana) { //if the damage deals is > at 30% of the current health of the target then it tries to use the defense spell
            $this->mana -= $this->defenseSpell->cost; //mana lost from the spell cast
            foreach ($finalDamage as $value) {
                $value *= $this->defenseSpell->value;
            }
        }

        return $finalDamage;
    }

    public function getDamageTanked(Character $attacker): float // getter for the function fightAlgorithm
    {
        return $this->damageTanked($attacker)["physicalDamage"] + $this->damageTanked($attacker)["magicalDamage"];
    }

    public function hit(Character $target): void
    {
        $damage = $target->damageTanked($this)["physicalDamage"] + $target->damageTanked($this)["magicalDamage"];
        // final damage done to the opponent
        $target->currentHealth -= $damage;

        $this->regeneratingMana();

        $target->updateState();

        if (!$target->isAlive) {
            $this->gainExp($target);
        }
    }

    public function heal(Character $target): void
    {
        if ($this->mana >= $this->healSpell->cost && $this->currentHealth <= $this->health * 0.6) { // conditions checked : has enough mana to cast AND has less than 60% hp
            $this->currentHealth += $this->healSpell->value;
        } else {
            $this->hit($target); // if the player doesn't have enough mana, then it hits instead of healing
        }
    }

    public function updateState(): void
    {
        // change the value of isAlive depends on the health state
        if ($this->currentHealth <= 0) {
            $this->isAlive = false;
        }
    }

    public function hasLeveledUp(): void
    {
        $this->level["level"] += 1;
        $this->level["exp"] = 0;
        $this->level["expNeededToLevelUp"] *= 1.5;

        // stats goes brrrr
        // it's default stats upgrade, it will change depending on the specialization, mage will gain more mana and magicStrength, etc..
        $this->health += $this->health * 0.5;
        $this->mana += $this->mana * 0.5;
        $this->physicalStrength += $this->physicalStrength * 0.5;
        $this->magicalStrength += $this->magicalStrength * 0.5;
        $this->physicalDefense += $this->physicalDefense * 0.5;
        $this->magicalDefense += $this->magicalDefense * 0.5;

        echo PHP_EOL;
        echo "{$this} is level " . $this->level["level"] . " !";
        echo PHP_EOL;
    }

    public function gainExp(Character $loser): void
    {

        $ratio = $loser->level["level"] / $this->level["level"];

        $this->level["exp"] += 50 * $ratio;
        if ($this->level["exp"] >= $this->level["expNeededToLevelUp"]) {
            $this->hasLeveledUp();
        }
    }

    private function regeneratingMana(): void
    {
        $this->mana += 20 * $this->level["level"];
    }
    public function __toString()
    {
        return $this->className;
    }
}
