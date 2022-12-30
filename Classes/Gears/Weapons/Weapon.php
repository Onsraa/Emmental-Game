<?php

namespace App\Classes\Gears\Weapons;
use App\Classes\Elements\Element;

    abstract class Weapon{

        protected Element $weaponElement; 

        public function __construct(
            protected string $type, //is it a physical weapon or a magical weapon ?
            protected string $weaponName,
            protected string $description,
            protected float $physicalDamage,
            protected float $magicalDamage,
            protected float $durability,
        )
        {
            //randomly assign an element to the weapon
            switch (rand(0,2))
            {
                case 0:
                    $element = "fire";
                    break;
                case 1:
                    $element = "plant";
                    break;
                case 2: 
                    $element = "water";
                    break;
            }
            $this->weaponElement = new Element($element);
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

    abstract public function addWeaponDamages(array $vanillaDamages, $bearerElement): array ;

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

    public function getElement(): Element
    {
        return $this->weaponElement;
    }

    public function __toString() 
    {
        return "{$this->getName()} : ".lcfirst($this->getDescription()).PHP_EOL;
    }
    }
