<?php

namespace App\Classes\Gears;
use App\Classes\Gears\Weapons\Weapon;
use App\Classes\Gears\Armors\Armor;
class Gear{

    public function __construct(
        public ?Weapon $equippedWeapon = null,
        public ?Armor $equippedArmor = null
    )
    {       
    }

    public function goesToTrash(Weapon | Armor $object) : void
    {
        if ($object->getDurability() == 0 ) 
            {
                $object = null;
                echo $object . " can't be used anymore." . PHP_EOL ; 
            }
    }
    
    public function __toString() 
    {
        return ($this->equippedWeapon) ? $this->equippedWeapon->__toString() :  $this->equippedArmor->__toString();
    }
}
