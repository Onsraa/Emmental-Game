<?php

namespace App\Classes\Spells\Offensive;

use App\Classes\Spells\Offensive\Offensive;

class LightningChain extends Offensive
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Lightning Chain",
            description: "Attacks enemies with electricity using magic power",
            cost: 65,
            owners: [],
            damage: ["physicalDamage" => 0, "magicalDamage" => 300],
        );
    }
}
