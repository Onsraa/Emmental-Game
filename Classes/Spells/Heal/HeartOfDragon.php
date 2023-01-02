<?php

namespace App\Classes\Spells\Heal;

use App\Classes\Spells\Heal\Heal;

class HeartOfDragon extends Heal
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Heart of Dragon",
            description: "Magic spell to regain life from the heart of the Dragon",
            cost: 100,
            heal: 500,
            factor: "fixed",
            owners: ["Draconist"],
        );
    }
}
