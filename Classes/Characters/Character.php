<?php

namespace App\Classes\Characters;

use App\Classes\Elements\Element;
use App\Classes\Gears\Gear;
use App\Classes\Gears\Weapons\Armor;
use App\Classes\Gears\Weapons\MagicalWeapons\PanFlute;
use App\Classes\Spells\Spell;
use App\Classes\Gears\Weapons\Weapon; 
use App\Classes\Gears\Weapons\MagicalWeapons\WandOfCallipso;
use App\Classes\Gears\Weapons\PhysicalWeapons\DevilAxe;

abstract class Character
{

    private bool $isAlive = true; // primary status to verify if the character is alive or not
    // public Element $myElement;

    public function __construct (
        protected string $className, // basically the specialization name of the character
        protected string $element, // the element which will define who he is weak against
        protected float $health,
        protected float $mana,
        protected float $physicalStrength, // basic stats without weapons and stuffs
        protected float $magicalStrength,
        protected float $physicalDefense,
        protected float $magicalDefense,
        //protected array $level = ["level" => (int)1, "exp" => (int)0, "expNeededToLevelUp" => (int)50],
        protected ?Gear $gear = null,
        protected ?Spell $offensiveSpell = null,
        protected ?Spell $defenseSpell = null,
        protected ?Spell $healSpell = null,
    ) {
        // $this->myElement = new Element($element);
    }

    public function damageDeals(): array
    { // function to calculate the damage before the damageTanked()
        $damageDeals = ["physicalDamage" => $this->gear->equippedWeapon->addWeaponDamages($this->physicalStrength), "magicalDamage" => $this->gear->equippedWeapon->addWeaponDamages($this->magicalStrength)];
        return $damageDeals;
    }

    public function damageTanked(): float
    { // function to calculate the final damage before the getHit()

        return 1;
    }

    public function getHit(Character $attacker, float $damage): void
    {   
        echo $attacker->className ; 
        $attacker->gear->equippedWeapon->breaks($attacker);

        echo $this->className ." (" . $this->health . ") get hit by " . $attacker->className . PHP_EOL ;
        $this->health -= $damage;
        echo "He has " . $this->health . " HP remaining." . PHP_EOL;
    }

    public function state(Character $target): bool
    {
        // change the value of isAlive depends on the health state
        if ($target->health <= 0) {
            $target->isAlive = false;
        }
        return $target->isAlive;
    }
 
    public function takesWeapon(int $weapon){
        $panFlute = new PanFlute();
        $WandOfCallipso = new WandOfCallipso();
        $devilAxe = new DevilAxe();

        $canUse = [0 =>$panFlute, 1 =>$WandOfCallipso, 2 =>$devilAxe];


        $this->gear = new Gear($canUse[$weapon]);
        echo $this->className . ' takes a ' . $canUse[$weapon] . PHP_EOL;
    }

    public function takesArmor()
    {      
        echo $this->className . ' takes an armor' . PHP_EOL ;   
    }

    public function takesGear(){
        if (rand(0,1) == 0 ){
            $this->takesWeapon(rand(0,2));
        } else 
        {
            $this->takesArmor();
        }
}
public function showGear(){
    echo 'The character has :' . $this->gear . PHP_EOL;
}
}
