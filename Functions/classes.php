<?php

use App\Classes\Characters\Character;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;
use App\Classes\Specializations\Chaman;
use App\Classes\Specializations\Kunochi;
use App\Classes\Specializations\Ninja;
use App\Classes\Specializations\Nova;
use App\Classes\Specializations\Shai;

function addClass($nickname)
{

    cls();
    $classes = ["Draconist", "Chaman", "FlowerFairy", "Kunochi", "Ninja", "Nova", "Shai"]; // Where you add classes
    $nbClasses = count($classes);

    echo "Select a class :" . PHP_EOL;
    echo PHP_EOL;
    foreach ($classes as $key => $value) {
        $character_nb = $key + 1;
        echo "{$character_nb} : {$value}" . PHP_EOL;
    }
    echo "0 : random" . PHP_EOL . PHP_EOL;

    do {
        $select_class = readline("Selection: ");
    } while ($select_class < 0 || $select_class > $nbClasses);

    if ($select_class == 0) {
        $select_class = (int)rand(1, $nbClasses);
    }

    foreach ($classes as $key => $value) {
        $character_nb = $key + 1;
        if ($select_class == $character_nb) {
            cls();
            echo "The {$value} has been created successfully." . PHP_EOL . PHP_EOL;
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
        case "Kunochi":
            return new Kunochi($nickname);
        case "Ninja":
            return new Ninja($nickname);
        case "Nova":
            return new Nova($nickname);
        case "Shai":
            return new Shai($nickname);
    }
}

function showAllClasses(array $classes): void
{
    echo PHP_EOL;
    foreach ($classes as $key => $value) {
        $character_nb = $key + 1;
        echo PHP_EOL . $character_nb . " : " . $value->getClassName() . " [level : {$value->getLevel()}]" . PHP_EOL;
    }
    echo PHP_EOL;
}

function chooseAnotherClass(array &$classes, string $nickname, Character &$current_character): void
{

    do {

        cls();
        echo "What do you want to do ?" . PHP_EOL;
        echo PHP_EOL . "1 - Choose another class" . PHP_EOL;
        echo PHP_EOL . "2 - Create a new class" . PHP_EOL;
        echo PHP_EOL . "3 - Nothing" . PHP_EOL . PHP_EOL;

        $answer = readline("Selection : ");
    } while ($answer < 1 && $answer > 3);

    switch ((int)$answer) {
        case 1:

            do {

                cls();
                echo "What class do you want to play ?" . PHP_EOL . PHP_EOL;
                echo "Here is your classes : ";
                showAllClasses($classes);
                $answer = readline("Selection : ") . PHP_EOL;
            } while ($answer < 1 && $answer > count($classes));

            cls();
            echo PHP_EOL;
            $current_character = $classes[$answer - 1];
            echo "You choose class n°" . $answer . " : The " . $classes[$answer - 1]->getClassName() . PHP_EOL;
            echo PHP_EOL;
            $classes[$answer - 1]->showSpec();
            break;
        case 2:
            array_push($classes, addClass($nickname));
            break;
        case 3:
            break;
    }
}
