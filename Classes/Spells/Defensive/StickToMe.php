<?php

namespace App\Classes\Spells\Defensive;

use App\Classes\Spells\Defensive\Defensive;

class StickToMe extends Defensive
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Stick to Me",
            description: "Raise your vitclari high into the air, spin it around, protecting allies",
            cost: 100,
            defense: 120,
            factor: "fixed",
            owners: ["Shai"],
        );
    }
}
