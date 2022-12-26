<?php

namespace App\Classes\Spells\Heal;

use App\CLasses\Spells\Spell;
abstract class Heal extends Spell{

    public function __construct(
        public string $spellName,
        public string $description,
        public int $cost,
        public float $heal
    )
    {
        parent::__construct($spellName, $description, $cost);
    }
}