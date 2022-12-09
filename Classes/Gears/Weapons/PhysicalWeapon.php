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
            parent::__construct($weaponName,
                                $description,
                                "physical",
                                $physicalDamage,
                                0,
                                $durability,
                                );
        }
        
    }
?>