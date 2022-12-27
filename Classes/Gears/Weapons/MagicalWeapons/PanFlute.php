<?php

namespace App\Classes\Gears\Weapons\MagicalWeapons;

use App\Classes\Gears\Weapons\MagicalWeapon;

class PanFlute extends MagicalWeapon
{
    function __construct()
    {
        parent::__construct("Pan flute",
                            "An old flute that belonged to Pan, a master of music and spells.",
                            8,
                            25,
                            );
    }
}