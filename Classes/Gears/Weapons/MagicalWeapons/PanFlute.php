<?php

namespace App\Classes\Gears\Weapons\MagicalWeapons;

use App\Classes\Gears\Weapons\MagicalWeapon;

class PanFlute extends MagicalWeapon
{
    function __construct(
        protected string $weaponName,
        protected string $description,
        protected float $magicalDamage,
        protected float $durability,
    )
    {
        parent::__construct("Pan flute",
                            "An old flute that belonged to Pan, a master of music and spells",
                            "magical",
                            0,
                            8,
                            25,
                            );
    }
}