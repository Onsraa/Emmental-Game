<?php

namespace App\Classes\Gears\Weapons\MagicalWeapons;

use App\Classes\Gears\Weapons\MagicalWeapon;

class WandOfCallipso extends MagicalWeapon
{
    public function __construct()
    {
        parent::__construct(
            "Callipso's wand",
            "An old wand that belonged to Callipso, a master of alchemy",
            10,
            10,
        );
    }
}
