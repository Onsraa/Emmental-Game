<?php

namespace App\Classes\Spells\Defensive;

use App\Classes\Spells\Defensive\Defensive;

class DragonSkin extends Defensive
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Dragon skin",
            description: "Hardens skin as hard as a dragon's",
            cost: 40,
            defense: 40,
            factor: "ratio",
            owners: ["Draconist"],
        );
    }
}
