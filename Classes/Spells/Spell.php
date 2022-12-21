<?php

namespace App\Classes\Spells;

class Spell
{

    public function __construct(
        public string $spellName,
        public int $cost,
        public int $value
    ) {
    }
}
