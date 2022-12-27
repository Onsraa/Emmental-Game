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
    ) {
    }
}
