<?php

namespace App\Classes\Specializations;

use App\Classes\Characters\Character;
use App\Classes\Spells\Offensive\DragonBreath;

class Draconist extends Character
{
    public function __construct()
    {
        parent::__construct(
            className: "Draconist",       // basically the specialization name of the character
            element: "fire",              // the element which will define who he is weak against
            health: 1000,                 // total fixed health points
            mana: 300,
            physicalStrength: 160,        // basic stats without weapons and stuffs
            magicalStrength: 250,
            physicalDefense: 150,
            magicalDefense: 100,
            offensiveSpell: new DragonBreath(),

        );
    }
}
