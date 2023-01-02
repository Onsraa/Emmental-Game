<?php

namespace App\Classes\Gears\Armors;

use App\Classes\Gears\Armors\Armor;

class HelmetOfAthena extends Armor
{
    public function __construct()
    {
        parent::__construct(
            "Athena's Helmet",
            "The helmet which led to victory.",
            80,
            35,
            10
        );
    }
}
