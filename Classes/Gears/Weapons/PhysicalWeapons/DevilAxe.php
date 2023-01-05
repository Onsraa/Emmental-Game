<?php

namespace App\Classes\Gears\Weapons\PhysicalWeapons;

use App\Classes\Gears\Weapons\PhysicalWeapon;

class DevilAxe extends PhysicalWeapon
{
    function __construct()
    {
        parent::__construct(
            "Devil Axe",
            "An old axe that belonged to a titan, a master of rocks and violence",
            15,
            6,
        );
    }
}
