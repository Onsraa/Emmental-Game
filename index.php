<?php

require_once("./Autoload.php");
require_once("./Functions/rng.php");
require_once("./Functions/fight.php");

use App\Classes\Specializations\Chaman;
use App\Classes\Specializations\Draconist;
use App\Classes\Specializations\FlowerFairy;

$classes = ["Draconist", "Chaman", "FlowerFairy"];

$nbClasses = count($classes);

echo PHP_EOL;
$name = readline("What is your name ? ") . PHP_EOL;
echo "Welcome {$name}";

echo PHP_EOL;
echo "Choose your class : [";
foreach ($classes as $key => $value) {
    echo $value;
    echo ($key != $nbClasses - 1) ? ", " : "]";
}
echo PHP_EOL;
$choice = readline();
echo PHP_EOL;

while (!in_array($choice, $classes, TRUE)) {
    echo "You have to choose an existing class." . PHP_EOL;
    $choice = readline();
}

switch ($choice) {
    case "Draconist":
        $user = new Draconist($name);
        break;
    case "Chaman":
        $user = new Chaman($name);
        break;
    case "FlowerFairy":
        $user = new Draconist($name);
        break;
}
echo "You're now a {$choice} !";
$user->showSpec();
