<?php

namespace App\Classes\Specialisations;

use App\Classes\Characters\Character;

class Draconist extends Character
{

    function __construct()
    {
        parent::__construct(
            className: "Draconist",       // basically the specialization name of the character
            element: "fire",              // the element which will define who he is weak against
            health: 1000,                 // total fixed health points
            mana: 300,
            physicalStrength: 150,        // basic stats without weapons and stuffs
            magicalStrength: 200,
            physicalDefense: 100,
            magicalDefense: 50,
        );
    }
}
