<?php

namespace App\Classes\Specializations;

use App\Classes\Characters\Character;
use App\Classes\Spells\Offensive\DragonBreath;

class Ninja extends Character
{
    public function __construct($username)
    {
        parent::__construct(
            username: $username,
            className: "Ninja",       // basically the specialization name of the character
            element: "fire",              // the element which will define who he is weak against
            health: 650,                 // total fixed health points
            mana: 280,
            physicalStrength: 210,        // basic stats without weapons and stuffs
            magicalStrength: 0,
            physicalDefense: 150,
            magicalDefense: 100,

        );
    }
}
