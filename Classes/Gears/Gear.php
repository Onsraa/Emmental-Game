<?php

namespace App\Classes\Gears;
use App\Classes\Gears\Weapons\Weapon;
use App\Classes\Gears\Weapons\Armor;
class Gear{

    public function __construct(
        public ?Weapon $equippedWeapon = null,
        public ?Armor $equippedArmor = null
    )
    {
        
    }

}
