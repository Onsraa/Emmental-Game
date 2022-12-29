<?php

namespace App\Classes\Spells\Offensive;

use App\Classes\Spells\Offensive\Offensive;
class DragonBreath extends Offensive
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Dragon Breath",
            description: "Very powerful breath from an ancient fire Dragon",
            cost: 100,
            damage: ["physicalDamage" => 0, "magicalDamage" => 500],
        );
    }
}
