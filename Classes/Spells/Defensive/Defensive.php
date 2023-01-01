<?php

namespace App\Classes\Spells\Defensive;

use App\CLasses\Spells\Spell;

class Defensive extends Spell
{

    public function __construct(
        public string $spellName,
        public string $description,
        public int $cost,
        public float $defense,
        public string $factor,
        public ?array $owners
    ) {
        parent::__construct($spellName, $description, $cost);
    }
}
