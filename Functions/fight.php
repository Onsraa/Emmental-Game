<?php

use App\Classes\Characters\Character;
function fight(Character $attacker, Character $victim): void{
    while($attacker->state()){

        $attacker->hit($victim);

        $tmp_target = $victim;
        $victim = $attacker;
        $attacker = $tmp_target;
    }

    echo "The {$victim} wins !";
}

?>