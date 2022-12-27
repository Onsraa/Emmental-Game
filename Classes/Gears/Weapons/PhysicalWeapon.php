<?php

namespace App\Classes\Gears\Weapons;
    abstract class PhysicalWeapon extends Weapon{

        function __construct(
            protected string $weaponName,
            protected string $description,
            protected float $physicalDamage,
            protected float $durability,
        )
        {
            parent::__construct("physical",
                                $weaponName,
                                $description,
                                $physicalDamage,
                                0,
                                $durability,
                                );
        }

        public function addWeaponDamages($vanillaDamages): float
        {
            return $vanillaDamages + $this->physicalDamage;
        }

    }
?>