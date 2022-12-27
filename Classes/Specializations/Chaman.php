<?php

namespace App\Classes\Specializations;

use App\Classes\Characters\Character;

class Chaman extends Character
{

    public function __construct($username)
    {
        parent::__construct(
            username: $username,
            className: "Chaman",           // basically the specialization name of the character
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
