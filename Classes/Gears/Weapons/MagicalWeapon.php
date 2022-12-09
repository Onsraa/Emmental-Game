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
            parent::__construct($weaponName,
                                $description,
                                "magical",
                                0,
                                $magicalDamage,
                                $durability,
                                );
        }

        public function break(): void
        {
            
        }
    }
