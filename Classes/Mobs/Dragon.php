<?php

namespace App\Classes\Mobs;

use App\Classes\Characters\Character;

class Dragon extends Character
{

    public function __construct()
    {
        parent::__construct(
            username: "Grougaloragran",
            className: "Dragon",           // basically the specialization name of the character
            element: "fire",              // the element which will define who he is weak against
            health: 2000,                  // total fixed health points
            mana: 1000,
            physicalStrength: 200,        // basic stats without weapons and stuffs
            magicalStrength: 500,
            physicalDefense: 500,
            magicalDefense: 300,
        );
    }
}
