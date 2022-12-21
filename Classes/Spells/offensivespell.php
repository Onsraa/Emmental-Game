<?php

namespace App\Classes\Spells;
use App\Classes\Characters\Character;
abstract class offensiveSpell extends Spell
{
    function __construct(
        public string $spellName,
        public string $description,
        public int $physicalValue,
        public int $magicalValue,
        public int $manaCost,
        public string $elemental #element
    )
    {
    parent::__construct(spellName: $this->spellName, description: $this->description, manacost: $this->manaCost);
    }

}