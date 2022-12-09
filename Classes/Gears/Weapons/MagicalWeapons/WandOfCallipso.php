<?php

namespace App\Classes\Gears\Weapons\MagicalWeapons;

use App\Classes\Gears\Weapons\MagicalWeapon;

class WandOfCallipso extends MagicalWeapon
{
    function __construct(
        protected string $weaponName,
        protected string $description,
        protected float $magicalDamage,
        protected float $durability,
    )
    {
        parent::__construct("Callipso's wand",
                            "An old wand that belonged to Callipso, a master of alchemy",
                            "magical",
                            0,
                            10,
                            20,
                            );
    }
}