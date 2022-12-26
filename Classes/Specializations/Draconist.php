<?php

namespace App\Classes\Specialisations;

use App\Classes\Characters\Character;

class Draconist extends Character
{

    public function __construct()
    {
        parent::__construct(
            className: "Draconist",       // basically the specialization name of the character
            element: "fire",              // the element which will define who he is weak against
            health: 1000,                 // total fixed health points
            mana: 300,
            physicalStrength: 100,        // basic stats without weapons and stuffs
            magicalStrength: 250,
            physicalDefense: 150,
            magicalDefense: 100,
        );
    }
}
