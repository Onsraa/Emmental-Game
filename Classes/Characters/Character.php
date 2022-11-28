<?php


abstract class Character {

    private bool $isAlive = true;
    
    function __construct(
        protected string $className,
        protected string $element,
        protected float $health,
        protected float $mana,
        protected float $physicalStrenght, // basic stats without weapons and stuffs
        protected float $magicalStrenght,
        protected float $physicalDefense,
        protected float $magicalDefense,
        protected array $level = ["level" => 1, "exp" => 0],
        protected ?Spell $offensiveSpell = null,
        protected ?Spell $defenseSpell= null,
        protected ?Spell $healSpell= null,
        )
    {
        
    }

    public function damageDeals(Character $character): float{ //a function to calculate the damage before the getHit() function
        
    }

    public function getHit(Character $victim, float $damage): void{
        
        //$victim->health -= $finalDamage;
    }

    public function state(): bool{
        return $this->$isAlive;
    }
}
