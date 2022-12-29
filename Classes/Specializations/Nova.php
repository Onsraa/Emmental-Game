<?php

namespace App\Classes\Specializations;

use App\Classes\Characters\Character;
use App\Classes\Spells\Offensive\DragonBreath;

class Nova extends Character
{
    public function __construct($username)
    {
        parent::__construct(
            username: $username,
            className: "Nova",       // basically the specialization name of the character
            element: "fire",              // the element which will define who he is weak against
            health: 1000,                 // total fixed health points
            mana: 300,
            physicalStrength: 80,        // basic stats without weapons and stuffs
            magicalStrength: 0,
            physicalDefense: 165,
            magicalDefense: 150,
        );
    }
}
