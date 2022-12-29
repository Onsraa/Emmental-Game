<?php

use App\Classes\Characters\Character;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;
use App\Classes\Specializations\Chaman;


function addClass($nickname)
{

    $classes = ["Draconist", "Chaman", "FlowerFairy"]; // Where you add classes
    $nbClasses = count($classes);

    echo "Select a class :" . PHP_EOL;

    foreach ($classes as $key => $value) {
        $character_nb = $key + 1;
        echo "{$character_nb} : {$value}" . PHP_EOL;
    }
    echo "0 : random" . PHP_EOL;

    do {
        $select_class = readline("Selection: ");
    } while ($select_class < 0 || $select_class > $nbClasses);

    if ($select_class == 0) {
        $select_class = (int)rand(1, $nbClasses);
    }

    foreach ($classes as $key => $value) {
        $character_nb = $key + 1;
        if ($select_class == $character_nb) {
            return selectClass($nickname, $value);
        }
    }
}
function selectClass(string $nickname, string $class)
{
    
    switch ($class) {
        case "Draconist":
            return new Draconist($nickname);
        case "FlowerFairy":
            return new FlowerFairy($nickname);
        case "Chaman":
            return new Chaman($nickname);
    }
}
