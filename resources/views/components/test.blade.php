@props([
    'heading',
    'footer',
])

<div {{$attributes->merge(['class' => 'test','disabled' => true])}}>
    <div {{$header->attributes->class(['test2'=> true])}}>
        {{$header}}
    </div>
    <div>
        {{$slot}}
    </div>
</div>
