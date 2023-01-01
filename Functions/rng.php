<?php

function rng(int $percentage): bool{
    return rand() % 100 < $percentage;
}

?>