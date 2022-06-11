<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class Rate extends Field
{
    protected $view = 'fields.rate';

    protected $attributes = [
        'count' => 5,
        'step' => 1,
        'readonly' => false
    ];

    protected $inlineAttributes = [
        'title',
        'name',
        'haveRated'
    ];
}
