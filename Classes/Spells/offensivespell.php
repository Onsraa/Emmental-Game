<?php

namespace App\Classes\Spells;
use App\Classes\Characters\Character;
abstract class offensivespell extends Spell
{
    function __construct(
        public string $spellName,
        public string $description,
        public int $value,
        public int $manacost,
        public string $elemental #element
    )
    {
    parent::__construct(spellName: $this->spellName, description: $this->description, value: $this->value,manacost: $this->manacost);
    }
    function castspell(Character $character, int $value,int $manacost)
    {
            #because we have bonus damage whenever element is bla bla bla
            #return damage cast
            #set damage character -> deal damage -> set back base damage
    }
}