<?php

namespace App\Classes\Spells\Defensive;

use App\Classes\Spells\Defensive\Defensive;

class ProtectedArea extends Defensive
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Protected Area",
            description: "Creates a huge protected area to protect self, dramatically raising DP",
            cost: 40,
            defense: 50,
            factor: "fixed",
            owners: [null],
        );
    }
}
