<?php

namespace App\Classes\Gears\Weapons;

abstract class PhysicalWeapon extends Weapon
{

    public function __construct(
        protected string $weaponName,
        protected string $description,
        protected float $physicalDamage,
        protected float $durability,
    ) {
        parent::__construct(
            "physical",
            $weaponName,
            $description,
            $physicalDamage,
            0,
            $durability,
        );
    }

    public function addWeaponDamages(array $vanillaDamages, $bearerElement): array
    {   
        $pDamages = $this->physicalDamage;
        //If weapon and character elements are identical, more damages dealt.
        if ($this->weaponElement->compatibility($bearerElement) == null)
        {
            $pDamages *= 1.5 ;
        }
        
        return  [
                "physicalDamage" => $vanillaDamages["physicalDamage"] + $pDamages,
                "magicalDamage"  => $vanillaDamages["magicalDamage"] + $this->magicalDamage
        ];   

    }
}