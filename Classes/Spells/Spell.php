<?php

namespace App\Classes\Spells;
use App\Classes\Characters\Character;
abstract class Spell{

    function __construct(
        public string $spellName,
        public string $description,
        public int $value,
        public int $manacost,
    )
    {
        
    }
    abstract function castspell(Character $character,int $value,int $manacost);
}
