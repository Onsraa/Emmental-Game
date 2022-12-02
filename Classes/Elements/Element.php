<?php

namespace App\Classes\Elements;

use App\Classes\Characters\Character;
abstract class Element
{
    function __construct(
        protected ?string $element = null// the element which will define who he is weak against
    ) {
    }

    protected function compatibility(Character $targetted): ?string{
        
        return null;
    }
}
