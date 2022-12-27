<?php

namespace App\Classes\Spells\Offensive;

use App\CLasses\Spells\Spell;

class Offensive extends Spell
{

    public function __construct(
        public string $spellName,
        public string $description,
        public int $cost,
        public array $damage = ["physicalDamage" => null, "magicalDamage" => null],
        public ?array $owners,
    ) {
        parent::__construct($spellName, $description, $cost, $owners);
    }
}
