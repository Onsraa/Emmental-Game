<?php

namespace App\Classes\Gears\Weapons;
    abstract class Weapon{

        function __construct(
            protected string $weaponName,
            protected string $description,
            protected string $type, //NOT NEEDED ?is it a physical weapon or a magical weapon ?
            protected float $physicalDamage,
            protected float $magicalDamage,
            protected float $durability,
        )
        {
            
        }

    //Reduce durability then makes unusable the weapon
    public function break(): void
    {
        if ($this->durability - 1 == 0)
        {
            $this->durability = 0;
        } 
        else 
        {
            $this->durability -- ;
        }
        
    }

    //Getters: 
    public function getName(): string
    {
        return $this->name;
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
        return "{$this->getName()}, ".lcfirst($this->getDescription()).PHP_EOL;
    }
    }

?>