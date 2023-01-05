<?php

namespace App\Classes\Gears\Armors;

use App\Classes\Gears\Armors\Armor;

class AresCrown extends Armor
{
    public function __construct()
    {
        parent::__construct(
            "Ares's crown",
            "The crown of the God of War",
            100,
            25,
            3
        );
    }
}
