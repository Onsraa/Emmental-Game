<?php

namespace App\Classes\Gears\Weapons;
    abstract class MagicalWeapon extends Weapon{

        function __construct(
            protected string $weaponName,
            protected string $description,
            protected float $magicalDamage,
            protected float $durability,
        )
        {
            parent::__construct("magical",
                                $weaponName,
                                $description,
                                0,
                                $magicalDamage,
                                $durability,
                                );
        }

        public function addWeaponDamages($vanillaDamages): float
        {
            return $vanillaDamages + $this->magicalDamage;
        }

    }
