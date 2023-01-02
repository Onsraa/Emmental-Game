<?php

namespace App\Classes\Mobs;

use App\Classes\Characters\Character;

class Specter extends Character
{

    public function __construct()
    {
        parent::__construct(
            username: "Boo the kart racer",
            className: "Specter",           // basically the specialization name of the character
            element: "plant",              // the element which will define who he is weak against
            health: 1500,                  // total fixed health points
            mana: 500,
            physicalStrength: 100,        // basic stats without weapons and stuffs
            magicalStrength: 300,
            physicalDefense: 200,
            magicalDefense: 200,
        );
    }
}
