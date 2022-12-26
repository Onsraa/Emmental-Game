<?php

namespace App\Classes\Spells;

class Spell
{

    public function __construct(
        public string $spellName,
        public string $description,
        public int $cost,
    ) {
    }
}
