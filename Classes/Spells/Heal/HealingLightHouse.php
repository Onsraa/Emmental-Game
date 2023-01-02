<?php

namespace App\Classes\Spells\Heal;

use App\Classes\Spells\Heal\Heal;


class HealingLightHouse extends Heal
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Healing Lighthouse",
            description: "Uses enormous magical power to significantly recover the HP of self and friends",
            cost: 130,
            heal: 300,
            factor: "fixed",
            owners: ["FlowerFairy"],
        );
    }
}