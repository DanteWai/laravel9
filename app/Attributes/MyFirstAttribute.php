<?php

namespace App\Attributes;


use Attribute;

#[Attribute]
class MyFirstAttribute
{
    public function __construct(
        public string $myArgument
    )
    {
    }
}
