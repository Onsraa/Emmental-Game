<?php

namespace App\Classes\Characters;

use App\Classes\Elements\Element;
use App\Classes\Gears\Armors\HelmetOfAthena;
use App\Classes\Gears\Armors\AresCrown;
use App\Classes\Gears\Gear;
use App\Classes\Spells\Offensive\Offensive;
use App\Classes\Spells\Defensive\Defensive;
use App\Classes\Spells\Heal\Heal;
use App\Classes\Gears\Armors\Armor;
use App\Classes\Gears\Weapons\MagicalWeapons\PanFlute;
use App\Classes\Spells\Spell;
use App\Classes\Gears\Weapons\Weapon;
use App\Classes\Gears\Weapons\MagicalWeapons\WandOfCallipso;
use App\Classes\Gears\Weapons\PhysicalWeapons\DevilAxe;
use App\Classes\Spells\Offensive\DragonBreath;
use App\Classes\Spells\Offensive\EatThis;
use App\Classes\Spells\Offensive\LightningChain;
use App\Classes\Spells\Defensive\DragonSkin;
use App\Classes\Spells\Defensive\ProtectedArea;
use App\Classes\Spells\Defensive\StickToMe;
use App\Classes\Spells\Heal\HealingAura;
use App\Classes\Spells\Heal\HealingLightHouse;
use App\Classes\Spells\Heal\HeartOfDragon;

abstract class Character
{

    public bool $isAlive = true;    // primary status to verify if the character is alive or not
    public Element $myElement;      // element declared so it can be created as a new class in the construct function 
    public float $currentHealth;    // dynamic health points
    public float $currentMana;      // dynamic mana points
    protected array $level = array();

    public function __construct(
        private string $username,
        protected string $className,           // basically the specialization name of the character
        protected string $element,             // the element which will define who he is weak against
        public float $health = 0,              // total fixed health points
        protected float $mana = 0,
        protected float $physicalStrength = 0, // basic stats without weapons and stuffs
        protected float $magicalStrength = 0,
        protected float $physicalDefense = 0,
        protected float $magicalDefense = 0,
        protected ?Gear $gear = null,          // gear that contains the weapon and the armor (equipped)
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

        if ($this->gear && $this->gear->equippedWeapon) {
            $damage = $this->gear->equippedWeapon->addWeaponDamages($damage, $this->myElement);
        }
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
        if ($this->defensiveSpell && !$simulate) {
            if ($this->currentHealth * 0.3 <= $finalDamage && $this->defensiveSpell->cost <= $this->currentMana) { //if the damage deals is > at 30% of the current health of the target then it tries to use the defense spell
                $this->currentMana -= $this->defensiveSpell->cost; //mana lost from the spell cast
                echo PHP_EOL . $this->username . " used a defensive spell ; [{$this->defensiveSpell->spellName} / {$this->defensiveSpell->description}]" . PHP_EOL;
                echo "Spell cost : {$this->defensiveSpell->cost} | Mana points : {$this->currentMana}/{$this->mana} " . PHP_EOL . PHP_EOL;
                foreach ($finalDamage as &$value) {
                    ($this->defensiveSpell->factor == "fixed") ? $value += $this->defensiveSpell->defense : $value *= $this->defensiveSpell->defense;
                }
            }
        }

        //if the character has an armor equipped then : 
        if ($this->gear && $this->gear->equippedArmor && !$simulate) {
            $this->gear->equippedArmor->shields($finalDamage);
            echo "The enemy's attack dealt less damages thanks to the " . $this->gear->equippedArmor->getName() . " of " . $this->username . PHP_EOL;
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
            echo PHP_EOL . "It 's a critical hit !" . PHP_EOL;
        }
        switch ($this->myElement->compatibility($target->myElement)) {
            case "efficient":
                echo PHP_EOL . ucfirst($this->element) ." is strong against {$target->element}." . PHP_EOL ;
                echo "The attack deals 50% more damage." . PHP_EOL;
                break;
            case "ineffective":
                echo PHP_EOL . ucfirst($this->element) ." is weak against {$target->element}." . PHP_EOL ;
                echo "Misery ! The attack deals 30% less damage." . PHP_EOL;
                break;
            default:
                echo "The players elements are identical." . PHP_EOL;
                break;
        }

        echo PHP_EOL;
        echo "{$this} hits {$target} for {$totalDamage} !" . PHP_EOL ;
        echo PHP_EOL;
        
        //gear object losing life then eventually get thrown away.^M
        if ($this->gear && ($this->gear->equippedWeapon || $this->gear->equippedArmor))
        {
            $equippedObject = ($this->gear->equippedWeapon) ? $this->gear->equippedWeapon : $this->gear->equippedArmor ;
            
            if ($equippedObject->breaks() == 1)
            {
                $this->gear = $this->gear->goesToTrash($equippedObject);
            } else {
                echo "{$this}'s object ({$equippedObject}) is usable for " . $equippedObject->getDurability(). " turns before it breaks." . PHP_EOL;     
            }

        }
        
        echo PHP_EOL;
        echo PHP_EOL;
        echo "{$target}'s remaining HP : [{$target->currentHealth}/{$target->health}]";
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
                echo PHP_EOL . $this->username . " used a healing spell ; [{$this->healSpell->spellName} / {$this->healSpell->description}]" . PHP_EOL;
                echo "Spell cost : {$this->healSpell->cost} | Mana points : {$this->currentMana}/{$this->mana} " . PHP_EOL;
                echo $this->username . " (HP) : [{$this->currentHealth}/{$this->health}]" . PHP_EOL;
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
        echo "{$this} has leveled up :";
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
        return "{$this->username}, the {$this->className}";
    }
    public function restore()
    {
        $this->currentHealth = $this->health; //reset health after fight
        $this->currentMana = $this->mana; //reset health after fight
        $this->isAlive = true;
    }

    public function showSpec()
    {

        echo PHP_EOL;
        for ($i = 0; $i < 60; $i++) {
            echo "X";
        }
        echo PHP_EOL;
        $sentence = "Character informations";
        $length = strlen($sentence);

        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo $sentence;
        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo PHP_EOL;

        echo "  Username : {$this->username}" . PHP_EOL ;
        echo "  Class : {$this->className}" . PHP_EOL;
        echo "  Element : {$this->element}" . PHP_EOL;
        echo "  Level : {$this->level['level']}" . PHP_EOL;
        echo "  Xp [{$this->level['exp']}/{$this->level['expNeededToLevelUp']}] : ";

        (int)$currentXpIndication = $this->level['exp'] * 30 / $this->level['expNeededToLevelUp'];
        $restNeededToLevelUpIndication = 30 - $currentXpIndication;

        echo "[";
        for ($i = 0; $i < $currentXpIndication; $i++) {
            echo "#";
        }
        for ($j = 0; $j < $restNeededToLevelUpIndication; $j++) {
            echo " ";
        }
        echo "]" . PHP_EOL;

        $sentence = "Stats";
        $length = strlen($sentence);

        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo $sentence;
        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo PHP_EOL;
        echo "  Health : {$this->health}" . PHP_EOL;
        echo "  Mana : {$this->mana}" . PHP_EOL;
        echo "  Physical Strength : {$this->physicalStrength}" . PHP_EOL;
        echo "  Magical Strength : {$this->magicalStrength}" . PHP_EOL;
        echo "  Physical Defense : {$this->physicalDefense}" . PHP_EOL;
        echo "  Magical Defense : {$this->magicalDefense}" . PHP_EOL;

        $sentence = "Spells";
        $length = strlen($sentence);

        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo $sentence;
        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo PHP_EOL . "  Offensive : ";
        echo ($this->offensiveSpell) ? "{$this->offensiveSpell->spellName}" : "empty";
        echo PHP_EOL . "  Defensive : ";
        echo ($this->defensiveSpell) ? "{$this->defensiveSpell->spellName}" : "empty";
        echo PHP_EOL . "  Heal : ";
        echo ($this->healSpell) ? "{$this->healSpell->spellName}" : "empty";
        echo PHP_EOL;
        $sentence = "Gear";
        $length = strlen($sentence);

        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo $sentence;
        for ($i = 0; $i < (60 - $length) / 2; $i++) {
            echo "-";
        }
        echo PHP_EOL . "  Weapon : ";
        echo ($this->gear && $this->gear->equippedWeapon) ? "{$this->gear->equippedWeapon->getName()}" : "empty";
        echo PHP_EOL . "  Armor : ";
        echo ($this->gear && $this->gear->equippedArmor) ? "{$this->gear->equippedArmor->getName()}" : "empty";
        echo PHP_EOL;
        for ($i = 0; $i < 60; $i++) {
            echo "-";
        }
        echo PHP_EOL;
        for ($i = 0; $i < 60; $i++) {
            echo "X";
        }
        echo PHP_EOL . PHP_EOL;
    }

    public function takesWeapon(int $weapon)
    {
        $panFlute = new PanFlute();
        $WandOfCallipso = new WandOfCallipso();
        $devilAxe = new DevilAxe();

        $canUse = [0 => $panFlute, 1 => $WandOfCallipso, 2 => $devilAxe];

        $this->gear = new Gear($canUse[$weapon]);
        echo PHP_EOL . $this->className . ' takes a ' . $canUse[$weapon] . PHP_EOL;
    }

    public function takesArmor(int $armor)
    {
        $helmet = new HelmetOfAthena();
        $crown = new AresCrown();

        $canWear = [0 => $helmet, 1 => $crown];


        $this->gear = new Gear(null, $canWear[$armor]);
        echo PHP_EOL . $this->className . ' wears ';
        echo ($canWear[$armor] == null) ? "nothing to protect themself." . PHP_EOL : $canWear[$armor] . PHP_EOL; //should never happen now
    }

    public function takesGear()
    {
        $luckyLuck = rand(0, 2);

        if ($luckyLuck == 0) {
            $this->takesWeapon(rand(0, 2));
        } else if ($luckyLuck == 1) {
            $this->takesArmor(rand(0, 1));
        } else {
            echo PHP_EOL . "Oh no, " . $this->username . " is unlucky, they didn't get anything to help them in this fight. :c" . PHP_EOL;
        }
    }
    public function showGear()
    {
        if ($this->gear && ($this->gear->equippedArmor || $this->gear->equippedWeapon)) {
            echo $this->username . ' has ' . $this->gear . '.' . PHP_EOL;
        } else {
            echo $this->username . "'s gear is empty." . PHP_EOL;
        }
    }

    public function hasGear(): int
    {
        if ($this->gear && ($this->gear->equippedArmor || $this->gear->equippedWeapon))
        {
            return 1;
        } else 
        {
            return 0;
        }
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getLevel(): int
    {
        return $this->level['level'];
    }

    #Quang's stuff - spell
    public function setOffensive($selection): void
    {
        $eatThis = new EatThis();
        $dragonBreath = new DragonBreath();
        $lightningChain = new LightningChain();
        switch ($selection) {
            case "Eat This":
                if((!empty($eatThis->owners) && in_array($this->className,$eatThis->owners) )|| empty($eatThis->owners)){
                $this->offensiveSpell = $eatThis;
                    echo $this . " changed defend spell to " . $this->getDefensive() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
            case "Dragon Breath":
                if((!empty($dragonBreath->owners) && in_array($this->className,$dragonBreath->owners)) || empty($dragonBreath->owners)){
                $this->offensiveSpell = $dragonBreath;
                    echo $this . " changed defend spell to " . $this->getDefensive() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
            case "Lightning Chain":
                if(  (!empty($lightningChain->owners) && in_array($this->className,$lightningChain->owners) )|| empty($lightningChain->owners)){
                $this->offensiveSpell = $lightningChain;
                    echo $this . " changed defend spell to " . $this->getDefensive() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
        }
    }
    public function setDefensive($selection): void
    {
        $dragonSkin = new DragonSkin();
        $protectedArea = new ProtectedArea();
        $stickToMe = new StickToMe();
        switch ($selection) {
            case "Dragon Skin":
                if((!empty($dragonSkin->owners) && in_array($this->className,$dragonSkin->owners) ) || empty($dragonSkin->owners)){
                $this->defensiveSpell = $dragonSkin;
                    echo $this . " changed defend spell to " . $this->getDefensive() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
            case "Protected Area":
                if( (!empty($protectedArea->owners) && in_array($this->className,$protectedArea->owners) ) || empty($protectedArea->owners)){
                $this->defensiveSpell = $protectedArea;
                    echo $this . " changed defend spell to " . $this->getDefensive() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
            case "Stick To Me":
                if( (!empty($stickToMe->owners) && in_array($this->className,$stickToMe->owners) )|| empty($stickToMe->owners)){
                $this->defensiveSpell = $stickToMe;
                echo $this . " changed defend spell to " . $this->getDefensive() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
        }
    }

    public function setHealSpell($selection): void
    {
        $healingAura = new HealingAura();
        $healingLightHouse = new HealingLightHouse();
        $heartOfDragon = new HeartOfDragon();

        switch ($selection) {
            case "Healing Aura":
                if ( (!empty($healingAura->owners) &&in_array($this->className,$healingAura->owners) )|| empty($healingAura->owners)){
                $this->healSpell = $healingAura;
                    echo $this . " changed heal spell to " . $this->getHealSpell() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
            case "Healing Light House":
                if ((!empty($healingLightHouse->owners) &&in_array($this->className,$healingLightHouse->owners)) || empty($healingLightHouse->owners)){
                $this->healSpell = $healingLightHouse;
                    echo $this . " changed heal spell to " . $this->getHealSpell() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
            case "Heart Of Dragon":
                if ((!empty($heartOfDragon->owners) &&in_array($this->className,$heartOfDragon->owners)) || empty($heartOfDragon->owners)){
                $this->healSpell = $heartOfDragon;
                echo $this . " changed heal spell to " . $this->getHealSpell() . PHP_EOL;
                } else {echo "Your class can not use this spell.";}
                break;
        }
    }

    public function getOffensive(): string
    {
        if (isset($this->offensiveSpell)) {

            return $this->offensiveSpell->spellName;
        } else return "Nothing";
    }
    public function getDefensive(): string
    {
        if (isset($this->defensiveSpell)) {

            return $this->defensiveSpell->spellName;
        } else return "Nothing";
    }
    public function getHealSpell(): string
    {
        if (isset($this->healSpell)) {

            return $this->healSpell->spellName;
        } else return "Nothing";
    }
}
