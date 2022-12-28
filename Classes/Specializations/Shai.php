<?php

namespace App\Classes\Specializations;

use App\Classes\Characters\Character;
use App\Classes\Spells\Defensive\StickToMe;

class Shai extends Character #We should add class type or describe but who care ?
{

    public function __construct($username)
    {
        parent::__construct(
            username: $username,
            className: "Shai",       // basically the specialization name of the character
            element: "water",              // the element which will define who he is weak against
            health: 900,                 // total fixed health points
            mana: 400,
            physicalStrength: 250,        // basic stats without weapons and stuffs
            magicalStrength: 50,
            physicalDefense: 125,
            magicalDefense: 150,
            defensiveSpell:new StickToMe(),
        );
    }
}
