<?php
use App\Classes\Characters\Character;
function chooseAnotherSpell(Character &$current_character):void{
    cls();
    echo "1. Choose another attack spell.".PHP_EOL;
    echo "2. Choose another defend spell.".PHP_EOL;
    echo "3. Choose another heal spell.".PHP_EOL;
    $selection = readline("Selection: ");
    switch($selection){
        case 1:
            selectOffensiveSpell($current_character);
            break;
        case 2:
            selectDefendSpell($current_character);
            break;
        case 3:
            selectHealSpell($current_character);
            break;
    }
}
function selectOffensiveSpell(Character &$current_character):void{
    cls();
    $offensiveSpell = ["Dragon Breath", "Eat This","Lightning Chain"];
    $quantity = 1;
    echo"Your current attack spell : ".$current_character->getOffensive().PHP_EOL;
    foreach ($offensiveSpell as $value){
        echo $quantity.": ".$value.PHP_EOL;
        $quantity++;
    }
    echo"0: Random ".PHP_EOL;
    $selection = readline("Your selection [0]:" );
    if ($selection == 0){
        $selection = rand(1,count($offensiveSpell));
    }
    if ($selection >= 1 && $selection <= count($offensiveSpell)){
        $selection = $offensiveSpell[$selection-1];
    }
    $current_character->setOffensive($selection);
}
function showOffensiveSpell(Character &$current_character):void{
    echo $current_character->getOffensive();
}
function selectDefendSpell(Character &$current_character):void{
    cls();
    $defendSpell = ["Dragon Skin","Protected Area","Stick To Me"];
    $quantity = 1;
    echo"Your current defend spell : ".$current_character->getDefensive().PHP_EOL;
    foreach ($defendSpell as $value){
        echo $quantity.": ".$value.PHP_EOL;
        $quantity++;
    }
    echo"0: Random ".PHP_EOL;
    $selection = readline("Your selection [0]:" );
    if ($selection == 0){
        $selection = rand(1,count($defendSpell));
    }
    if ($selection >= 1 && $selection <= count($defendSpell)){
        $selection = $defendSpell[$selection-1];
    }
    $current_character->setDefensive($selection);
}
function showDefendSpell(Character &$current_character):void{
    echo $current_character->getDefensive();
}
function selectHealSpell(Character &$current_character):void{
    cls();
    $healSpell = ["Healing Aura","Healing Light House","Heart Of Dragon"];
    $quantity = 1;
    echo"Your current heal spell : ".$current_character->getHealSpell().PHP_EOL;
    foreach ($healSpell as $value){
        echo $quantity.": ".$value.PHP_EOL;
        $quantity++;
    }
    echo"0: Random ".PHP_EOL;
    $selection = readline("Your selection [0]:" );
    if ($selection == 0){
        $selection = rand(1,count($healSpell));
    }
    if ($selection >= 1 && $selection <= count($healSpell)){
        $selection = $healSpell[$selection-1];
    }
    $current_character->setHealSpell($selection);
}
function showHealSpell(Character &$current_character):void{
    echo $current_character->getHealSpell();
}