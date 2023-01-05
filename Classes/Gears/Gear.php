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

    public function goesToTrash(Weapon | Armor $object) 
    {
        if ($object->getDurability() == 0 ) 
            {
                echo $object . " can't be used anymore." . PHP_EOL ; 

                return null;
            }
    }
    
    public function __toString() 
    {
        return ($this->equippedWeapon != null) ? $this->equippedWeapon->__toString() :  $this->equippedArmor->__toString();
    }
}
