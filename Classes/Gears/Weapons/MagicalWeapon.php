<?php

namespace App\Classes\Gears\Weapons;

abstract class MagicalWeapon extends Weapon
{

    public function __construct(
        protected string $weaponName,
        protected string $description,
        protected float $magicalDamage,
        protected float $durability,
    ) {
        parent::__construct(
            "magical",
            $weaponName,
            $description,
            0,
            $magicalDamage,
            $durability,
        );
    }

    public function addWeaponDamages(array $vanillaDamages): array
    {
        return  [
                "physicalDamage" => $vanillaDamages["physicalDamage"] + $this->physicalDamage,
                "magicalDamage"  => $vanillaDamages["magicalDamage"] + $this->magicalDamage
        ];   

    }
}
