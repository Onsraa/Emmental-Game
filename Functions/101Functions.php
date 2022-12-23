<?php
use App\Classes\Characters\Character;
use \App\Classes\Spells\Defensive\Defensive;
function in_range($number,$min,$max): bool
{
    if ($number <= $max && $number >= $min){
        return true;
    }else {
        echo "Your selection is invalid, please choose again".PHP_EOL.PHP_EOL;
        return false;}
}
