<?php

namespace App\Classes\Specializations;

use App\Classes\Characters\Character;

class FlowerFairy extends Character
{

    public function __construct()
    {
        parent::__construct(
            className: "Flower Fairy",       // basically the specialization name of the character
            element: "plant",              // the element which will define who he is weak against
            health: 900,                 // total fixed health points
            mana: 400,
            physicalStrength: 50,        // basic stats without weapons and stuffs
            magicalStrength: 250,
            physicalDefense: 100,
            magicalDefense: 200,
        );
    }
}
