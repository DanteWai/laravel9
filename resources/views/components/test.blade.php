<div {{$attributes->merge(['class' => 'test','disabled' => true])}}>
    <div {{$header->attributes->class(['test2'=> true])}}>
        {{$header}}
    </div>

    <div>
        hello, count is: {{$count}}
    </div>
    <div>
        {{$menuItems->count()}}
    </div>

    <div>
        {{$test('string')}}
    </div>

    <div>
        {{$slot}}
    </div>

</div>
