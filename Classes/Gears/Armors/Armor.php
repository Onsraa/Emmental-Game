<?php

namespace App\Classes\Gears\Armors;

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

         //Reduce durability then makes unusable the weapon
        public function breaks(): int
        {
            if ($this->durability - 1 == 0)
            {
                $this->durability = 0;
                return 1;
            } 
            else 
            {
                $this->durability -- ;
                return 0;
            }
        }

        //character receives less damages thanks to the armor
        public function shields(array $damageReceived): array
        {   
            return  [
                "physicalDamage" => $damageReceived["physicalDamage"] - $this->physicalDefense,
                "magicalDamage"  => $damageReceived["magicalDamage"] - $this->magicalDefense
            ];   
        }
        
        //Getters: 
        public function getName(): string
        {
            return $this->armorName;
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
            return "{$this->getName()} : ".lcfirst($this->getDescription());
        }
    }
