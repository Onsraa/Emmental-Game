<?php

namespace App\Classes\Characters;

use App\Classes\Elements\Element;
use App\Classes\Gears\Gear;
use App\Classes\Spells\Offensive\Offensive;
use App\Classes\Spells\Defensive\Defensive;
use App\Classes\Spells\Heal\Heal;

abstract class Character
{

    public bool $isAlive = true; // primary status to verify if the character is alive or not
    public Element $myElement; // element declared so it can be created as a new class in the construct function 
    public float $currentHealth;   // dynamic health points
    public float $currentMana;   // dynamic mana points
    protected array $level = array();

    public function __construct(
        protected string $className,       // basically the specialization name of the character
        protected string $element,         // the element which will define who he is weak against
        public float $health = 0,           // total fixed health points
        protected float $mana = 0,
        protected float $physicalStrength = 0, // basic stats without weapons and stuffs
        protected float $magicalStrength = 0,
        protected float $physicalDefense = 0,
        protected float $magicalDefense = 0,
        protected ?Gear $gear = null, //gear that contains the weapon and the armor (equipped)
        protected ?Gear $bag = null, // gear that contains the weapon and the armor (broken or not)
        protected ?Offensive $offensiveSpell = null,
        protected ?Defensive $defensiveSpell = null,
        protected ?Heal $healSpell = null,
    ) {
        $this->myElement = new Element($element);
        $this->currentHealth = $health;
        $this->currentMana = $mana;
        $this->level = ["level" => (int) 1, "exp" => (int) 0, "expNeededToLevelUp" => (int) 50];  //the higher the level, the higher the stats will be

    }

    protected function damageDeals(bool $simulate = false): array
    { // function to calculate the damage before the damageTanked()


        $damage = ["physicalDamage" => $this->physicalStrength, "magicalDamage" => $this->magicalStrength];

        // if the character has an offensive spell then :
        if ($this->offensiveSpell) {
            if ($this->currentMana >= $this->offensiveSpell->cost) {
                if (!$simulate) {
                    echo PHP_EOL . "An offensive spell is casted : [{$this->offensiveSpell->spellName} : {$this->offensiveSpell->description}]" . PHP_EOL;
                    $this->currentMana -= $this->offensiveSpell->cost;
                    echo "Spell cost : {$this->offensiveSpell->cost} | Mana points : {$this->currentMana}/{$this->mana} " . PHP_EOL;
                }
                $damage["physicalDamage"] = $this->offensiveSpell->damage["physicalDamage"];
                $damage["magicalDamage"] = $this->offensiveSpell->damage["magicalDamage"];
            }
        }

        //critical chance | damage multiplied by 2
        if (rng(15) && !$simulate) { // 15% crit chance 
            foreach ($damage as &$value) {
                $value *= 2;
            }
            array_push($damage, 0); // indication do check if the damage is a crit or not, it will push a value to the array : $damage = [0 : 0, "physicalDamage" : 123, "magicalDamage" : 123]
        }

        return $damage;
    }

    protected function damageTanked(Character $attacker, bool $simulate = false): array // simulate is a parameter to check if the function called is a simulation or not, simulation is used to verify conditions for the fight algorithm
    { // function to calculate the final damage before the hit()

        $finalDamage = $attacker->damageDeals($simulate);

        $finalDamage["physicalDamage"] -= $this->physicalDefense;
        $finalDamage["magicalDamage"] -= $this->magicalDefense;

        foreach ($finalDamage as &$value) {
            if ($value < 0) {
                $value = 0;
            }
        }

        switch ($attacker->myElement->compatibility($this->myElement)) {
            case "efficient":
                foreach ($finalDamage as &$value) {
                    $value *= 1.5;
                }
                break;
            case "ineffective":
                foreach ($finalDamage as &$value) {
                    $value *= 0.7;
                }
                break;
            default:
                break;
        }
        // if the character has a defensive spell then :
        if ($this->defensiveSpell) {
            if ($this->currentHealth * 0.3 <= $finalDamage && $this->defensiveSpell->cost <= $this->currentMana) { //if the damage deals is > at 30% of the current health of the target then it tries to use the defense spell
                $this->currentMana -= $this->defensiveSpell->cost; //mana lost from the spell cast
                echo "Spell cost : {$this->defensiveSpell->cost} | Mana points : {$this->currentMana}/{$this->mana} " . PHP_EOL;
                foreach ($finalDamage as &$value) {
                    ($this->defensiveSpell->factor == "fixed") ? $value += $this->defensiveSpell->defense : $value *= $this->defensiveSpell->defense;
                }
            }
        }

        return $finalDamage;
    }

    public function potentialDeath(Character $target): bool // look at the damage deal to determine if it can kill this turn or not
    {
        $damage = $target->damageTanked($this, simulate: true);
        $totalDamage = $damage["physicalDamage"] + $damage["magicalDamage"];
        if ($totalDamage >= $target->currentHealth) {
            return true;
        }
        return false;
    }

    public function hit(Character $target): void
    {
        $damage = $target->damageTanked($this);
        $totalDamage = $damage["physicalDamage"] + $damage["magicalDamage"];
        // final damage done to the opponent
        $target->currentHealth -= $totalDamage;

        if (isset($damage[0])) {
            echo PHP_EOL . "Critical hit !" . PHP_EOL;
        }
        switch ($this->myElement->compatibility($target->myElement)) {
            case "efficient":
                echo PHP_EOL . "Damage is effective ! It gains 50% more damage." . PHP_EOL;
                break;
            case "ineffective":
                echo PHP_EOL . "Misery ! The damage lost 30% of its value because of the element.." . PHP_EOL;
                break;
            default:
                break;
        }

        echo PHP_EOL;
        echo "The {$this} hit the {$target} for {$totalDamage} !";
        echo PHP_EOL;
        echo PHP_EOL;
        echo "Remain hp : [{$target->currentHealth}/{$target->health}]";
        echo PHP_EOL;

        $this->regeneratingMana();

        if ($target->currentHealth <= 0) {
            $target->isAlive = false;
            $this->gainExp($target);
        }
    }

    public function heal(Character $target): void
    {
        // if the character has a heal spell then :
        if ($this->healSpell) {
            if ($this->currentMana >= $this->healSpell->cost) { // conditions checked : has enough mana to cast AND has less than 60% hp
                ($this->healSpell->factor == "fixed") ? $this->currentHealth += $this->healSpell->heal : $this->currentHealth *= $this->healSpell->heal;
                $this->currentMana -= $this->healSpell->cost;
                echo "Spell cost : {$this->healSpell->cost} | Mana points : {$this->currentMana}/{$this->mana} " . PHP_EOL;
            } else {
                $this->hit($target); // if the player doesn't have enough mana, then it hits instead of healing
            }
        } else {
            $this->hit($target);
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
        echo "The {$this} has leveled up :";
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
        $this->currentMana += 20 * $this->level["level"];
    }
    public function __toString()
    {
        return $this->className;
    }
    public function restore()
    {
        $this->currentHealth = $this->health; //reset health after fight
        $this->currentMana = $this->mana; //reset health after fight
        $this->gear = $this->bag; //reset broken gear
    }
}
