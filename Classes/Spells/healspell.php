<?php

namespace App\Classes\Spells;

use App\Classes\Characters\Character;

abstract class healspell extends Spell
{
    function __construct(
        public string $spellName,
        public string $description,
        public int $value,
        public int $manacost,

    )
    {
        parent::__construct(spellName: $this->spellName, description: $this->description, value: $this->value,manacost: $this->manacost);
    }
    function castspell(Character $character, int $value,int $manacost)
    {
        #bla bla bla
    }
}