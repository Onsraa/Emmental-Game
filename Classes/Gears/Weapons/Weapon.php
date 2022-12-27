<?php

namespace App\Classes\Gears\Weapons;
    abstract class Weapon{

        function __construct(
            protected string $weaponName,
            protected string $description,
            protected float $physicalDamage,
            protected float $magicalDamage,
            protected float $durability,
        )
        {
        }

    //Reduce durability then makes unusable the weapon
    public function breaks(): void
    {
        if ($this->durability - 1 == 0)
        {
            $this->durability = 0;
        } 
        else 
        {
            $this->durability -- ;
        }
        echo " 's weapon is usable for " . $this->durability . " turns before it breaks." . PHP_EOL;
    }

    abstract public function addWeaponDamages($vanillaDamages): array ;

    //Getters: 
    public function getName(): string
    {
        return $this->weaponName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function __toString() 
    {
        return "{$this->getName()} : ".lcfirst($this->getDescription()).PHP_EOL;
    }
    }
