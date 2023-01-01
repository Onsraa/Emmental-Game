<?php

namespace App\Classes\Spells\Offensive;

use App\Classes\Spells\Offensive\Offensive;
class EatThis extends Offensive
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Eat This!",
            description: "Throw weapon in the direction.",
            cost: 65,
            owners: ["Shai"],
            damage: ["physicalDamage" => 0, "magicalDamage" => 300],
        );
    }
}