<?php

namespace App\Classes\Gears\Weapons;
    abstract class Weapon{

        public function __construct(
            protected string $weaponName,
            protected string $description,
            protected string $type, //is it a physical weapon or a magical weapon ?
            protected float $physicalDamage,
            protected float $magicalDamage,
            protected int $durability,
        )
        {
            
        }
    }

?>