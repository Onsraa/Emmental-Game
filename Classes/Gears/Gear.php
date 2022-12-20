<?php

namespace App\Classes\Gears;
use App\Classes\Gears\Weapons\Weapon;
use App\Classes\Gears\Weapons\Armor;
class Gear{

    function __construct(
        public ?Weapon $equippedWeapon = null,
        public ?Armor $equippedArmor = null
    )
    {       
    }
}
