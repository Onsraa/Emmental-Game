<?php

namespace App\Classes\Spells;

abstract class Spell{

    function __construct(
        public string $spellName,
        public string $description,
        public int $manaCost,
    )
    {
        parent::__construct(spellName: $this->spellName, description: $this->description, manacost: $this->manaCost);

    }

}
