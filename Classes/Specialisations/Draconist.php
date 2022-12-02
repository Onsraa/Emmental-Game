<?php

namespace App\Classes\Specialisations;
use App\Classes\Characters\Character;
class Draconist extends Character{

    function __construct()
    {
        parent::__construct(
        className: "Draconist",
        element: "Fire",
        health: 1000,
        mana: 150,
        physicalStrenght: 200,
        magicalStrenght: 300,
        physicalDefense: 80,
        magicalDefense: 30,
        );
    }
}