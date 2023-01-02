<?php

namespace App\Classes\Mobs;

use App\Classes\Characters\Character;

class Goblin extends Character
{

    public function __construct()
    {
        parent::__construct(
            username: "Benjamin the pervert",
            className: "Goblin",           // basically the specialization name of the character
            element: "plant",              // the element which will define who he is weak against
            health: 300,                  // total fixed health points
            mana: 20,
            physicalStrength: 100,        // basic stats without weapons and stuffs
            magicalStrength: 300,
            physicalDefense: 200,
            magicalDefense: 200,
        );
    }
}
