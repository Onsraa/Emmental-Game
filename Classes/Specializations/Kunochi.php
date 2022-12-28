<?php

namespace App\Classes\Specializations;

use App\Classes\Characters\Character;
use App\Classes\Spells\Offensive\DragonBreath;

class Kunochi extends Character
{
    public function __construct($username)
    {
        parent::__construct(
            username: $username,
            className: "Kunochi",       // basically the specialization name of the character
            element: "water",              // the element which will define who he is weak against
            health: 700,                 // total fixed health points
            mana: 250,
            physicalStrength: 0,        // basic stats without weapons and stuffs
            magicalStrength: 130,
            physicalDefense: 120,
            magicalDefense: 140,
        );
    }
}
