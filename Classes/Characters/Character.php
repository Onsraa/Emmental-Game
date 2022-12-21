<?php

namespace App\Classes\Characters;

use App\Classes\Elements\Element;
use App\Classes\Gears\Gear;
use App\Classes\Spells\defendspell;
use App\Classes\Spells\healSpell;
use App\Classes\Spells\offensivespell;
use App\Classes\Spells\Spell;
use App\Classes\Gears\Weapons\Weapon;

abstract class Character
{

    private bool $isAlive = true; // primary status to verify if the character is alive or not
    public Element $myElement;

    function __construct(
        protected string $className, // basically the specialization name of the character
        protected ?Element $element, // the element which will define who he is weak against
        protected float $health,
        protected float $mana,
        protected float $physicalStrength, // basic stats without weapons and stuffs
        protected float $magicalStrength,
        protected float $physicalStrengthBonus,
        protected float $magicalStrengthBonus,
        protected float $physicalDefense,
        protected float $magicalDefense,
        protected float $physicalDefenseBonus,
        protected float $magicalDefenseBonus,
        protected array $level = ["level" => (int)1, "exp" => (int)0, "expNeededToLevelUp" => (int)50],
        protected ?Gear $gear = null,
        protected ?offensiveSpell $offensiveSpell = null,
        protected ?defendSpell $defenseSpell = null,
        protected ?healSpell $healSpell = null,
    ) {
        $this->myElement = new Element($element);
    }
    protected function defendSpell():void
    {
        if($this->mana >= $this->defenseSpell->manaCost){
            $this->magicalDefenseBonus += $this->defenseSpell->magicalValue;
            $this->physicalDefenseBonus+= $this->defenseSpell->physicalValue;
        }
    }
    protected function selfHeal():void
    {   if($this->mana >= $this->healSpell->manaCost){
        echo'Casting '.$this->healSpell->spellName.'.';
        $this->health += $this->healSpell->value;
        $this->mana -= $this->healSpell->manaCost;
        }
    }
    protected function attackSpellShortRanged():void
    {
        if ($this->mana >= $this->healSpell->manaCost) {
            $this->magicalStrengthBonus += $this->offensiveSpell->value;
            $this->magicalStrengthBonus += $this->offensiveSpell->value;
            $this->mana -= $this->offensiveSpell->manaCost;

        }
    }
    protected function damageDeals(Character $target): array
    { // function to calculate the damage before the damageTanked()
        return ["physicalDamage" => $this->physicalStrength, "magicalDamage" => $this->magicalStrength];

    }

    protected function damageDeal(Character $target, float $damage): void
    { // function to calculate the final damage before the getHit()
        if ($this->element == $target->element){ #If 2 character have same element
            if($this->magicalStrength != 0){ #If This character using magic damage
               $damage = $damage - $target->magicalDefense - $target->magicalDefenseBonus;

            } else { #If This character using physic dmg
                $damage = $damage - $target->physicalDefense - $target->physicalDefenseBonus;
            }

        } else if ($this->element->compatibility($target->element) == "efficient"){ #If $this->element effect $target->element
            if($this->magicalStrength != 0){ #If This character using magic damage
                $damage = 2*$damage - ($target->magicalDefense + $target->magicalDefenseBonus);
            } else { #If This character using physic dmg
                $damage = 2*$damage - ($target->physicalDefense + $target->physicalDefenseBonus);
            }
        }else { #Last case
            if($this->magicalStrength != 0){ #If This character using magic damage
                $damage = 0.5*$damage - ($target->magicalDefense + $target->magicalDefenseBonus);
            } else { #If This character using physic dmg
                $damage = 0.5*$damage - ($target->physicalDefense + $target->physicalDefenseBonus);
            }
        }
        $this->hit($target,$damage);
    }

    public function hit(Character $target, float $damage): void
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
