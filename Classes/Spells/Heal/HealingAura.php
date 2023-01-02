<?php

namespace App\Classes\Spells\Heal;

use App\Classes\Spells\Heal\Heal;


class HealingAura extends Heal
{

    public function __construct()
    {
        parent::__construct(
            spellName: "Healing Aura",
            description: "Recovers a certain amount of faraway frends",
            cost: 83,
            heal: 150,
            factor: "fixed",
            owners: [null],
        );
    }
}
