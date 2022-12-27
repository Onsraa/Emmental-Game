<?php

namespace App\Classes\Gears\Weapons;

    abstract class Armor{

        public function __construct(
            protected string $armorName,
            protected string $description,
            protected float $physicalDefense,
            protected float $magicalDefense,
            protected int $durability,
        )
        {
            
        }

        public function __toString() 
        {
            return "ARMOR" . PHP_EOL;
        }
    }
