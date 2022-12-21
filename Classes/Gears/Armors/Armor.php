<?php

namespace App\Classes\Gears\Weapons;

    abstract class Armor{

        public function __construct(
            protected string $armorName,
            protected string $description,
            protected string $type, //is it a physical weapon or a magical weapon ?
            protected float $physicalDefense,
            protected float $magicalDefense,
            protected int $durability,
        )
        {
            
        }
    }

?>