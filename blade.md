{{ $param }} - Вывод переменной с экраннированием

{!! $param !!} - Вывод переменной без экранирования

@{{ $param }} , @@if() - Не обрабатывать конструкции

```
Не обррабатывать секцию

@verbatim
    <div class="container">
    Hello, {{ name }}.
    </div>
@endverbatim
```


{{ Illuminate\Support\Js::from($array) }} - Преобразовать в json

@if @isset @empty

@unless($param) @endunless - отобразить если ложно

@auth @endauth

@guest @endguest

@production @endproduction

@env('staging') @env(['staging', 'production']) @endenv

Определить, есть ли в секции наследуемого шаблона содержимое
```html
@hasSection('navigation')
    <span>123</span> 
@endif
```

Определить, что в секции нет содержимого
```html
@hasSection('navigation')
    <span>123</span> 
@endif
```

Циклы
```html
https://laravel.com/docs/9.x/blade#the-loop-variable

@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
    @continue
    @break

    @if ($loop->first)
        This is the first iteration.
    @endif
    
    @if ($loop->last)
        This is the last iteration.
    @endif
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I'm looping forever.</p>
@endwhile
```

Классы по условию
```html
<span @class([
    'p-4',
    'font-bold' => $isActive,
    'text-gray-500' => ! $isActive,
    'bg-red' => $hasError,
])></span>
```

@checked, @selected, @disabled
```html
@checked(old('active', $user->active))
@selected(old('version') == $version)
@disabled($errors->isNotEmpty())
```

Включение подвидов
```html
@include('shared.errors')
@include('view.name', ['status' => 'complete'])
@includeIf('view.name', ['status' => 'complete']) - подключает представление если оно существует
@includeWhen($boolean, 'view.name', ['status' => 'complete'])
@includeUnless($boolean, 'view.name', ['status' => 'complete'])
@includeFirst(['custom.admin', 'admin'], ['status' => 'complete']) - подключает первое существующее

@each('view.name', $jobs, 'job') - подключает вид для каждого элемента в коллекции
@each('view.name', $jobs, 'job', 'view.empty')
```

@once @endonce - Директива @once позволяет вам определить часть шаблона, которая будет проанализирована только один раз за цикл визуализации

## Компоненты
Создание компонента
```html
php artisan make:component Alert
php artisan make:component forms.input --view - анонимный компонент
```

Отрисовка компонента
```html
<x-alert/>
<x-alert type="error" :message="$message"/>
<x-inputs.button/>

Экранирование
<x-button ::class="{ danger: isDeleting }">
    Submit
</x-button>
```

Регистрация компонента вне стандартных папок
```php
// AppServiceProvider.php
Blade::component(Test::class, 'testcomponent');
```

Получение параметров
```php
public $type;
public $message;

public function __construct($type, $message)
{
    $this->type = $type;
    $this->message = $message;
}

public function __construct($alertType)
{
    $this->alertType = $alertType;
}

<x-alert alert-type="danger" />
```

Методы компонента
```php
public function isSelected($option)
{
    return $option === $this->selected;
}

<option {{ $isSelected($value) ? 'selected="selected"' : '' }} value="{{ $value }}">
    {{ $label }}
</option>
```

Доступ к атрибутам и слотам в классах компонентов
```php
public function render()
{
    return function (array $data) {
        // $data['componentName'];
        // $data['attributes'];
        // $data['slot'];

        return '<div>Components content</div>';
    };
}
```
Скрытие атрибутов / методов
```php
/**
     * Тип предупреждения.
     *
     * @var string
     */
    public $type;

    /**
     * Свойства / методы, которые не должны использоваться в шаблоне компонента.
     *
     * @var array
     */
    protected $except = ['type'];
```

Атрибуты компонента
```php
<div {{ $attributes }}>
    <!-- Component content -->
</div>

<div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
    {{ $message }}
</div>

<div {{ $attributes->class(['p-4', 'bg-red' => $hasError]) }}>
    {{ $message }}
</div>

<button {{ $attributes->class(['p-4'])->merge(['type' => 'button']) }}>
    {{ $slot }}
</button>

В этом примере атрибут data-controller всегда будет начинаться с profile-controller
<div {{ $attributes->merge(['data-controller' => $attributes->prepends('profile-controller')]) }}>
    {{ $slot }}
</div>

{{ $attributes->filter(fn ($value, $key) => $key == 'foo') }}
{{ $attributes->whereStartsWith('wire:model') }}
{{ $attributes->whereDoesntStartWith('wire:model') }}
{{ $attributes->whereStartsWith('wire:model')->first() }}

@if ($attributes->has('class'))
    <div>Class attribute is present</div>
@endif
{{ $attributes->get('class') }}
```

Зарезервированные слова
```php
data
render
resolveView
shouldRender
view
withAttributes
withName
```

Слоты
```php
<div class="alert alert-danger">
    {{ $slot }}
</div>

 
<span class="alert-title">{{ $title }}</span>
 
<div class="alert alert-danger">
    {{ $slot }}
</div>

<x-alert>
    <x-slot:title>
        Server Error
    </x-slot>
 
    <strong>Whoops!</strong> Something went wrong!
</x-alert>
```

Слоты с ограниченной областью видимости

Если вы использовали фреймворк JavaScript, такой, как Vue, то вы, возможно, знакомы со «слотами с ограниченной областью видимости», которые позволяют получать доступ к данным или методам из компонента в вашем слоте. Вы можете добиться аналогичного поведения в Laravel, определив общедоступные методы или свойства в вашем компоненте и получив доступ к компоненту в вашем слоте через переменную $component. В этом примере мы предположим, что компонент x-alert имеет общедоступный метод formatAlert, определенный в его классе компонента:

```php
<x-alert>
    <x-slot name="title">
        {{ $component->formatAlert('Server Error') }}
    </x-slot>

    <strong>Whoops!</strong> Something went wrong!
</x-alert>
```

Атрибуты слотов
```php
<x-card class="shadow-sm">
    <x-slot name="heading" class="font-bold">
        Heading
    </x-slot>

    Content

    <x-slot name="footer" class="text-sm">
        Footer
    </x-slot>
</x-card>

@props([
    'heading',
    'footer',
])

<div {{ $attributes->class(['border']) }}>
    <h1 {{ $heading->attributes->class(['text-lg']) }}>
        {{ $heading }}
    </h1>

    {{ $slot }}

    <footer {{ $footer->attributes->class(['text-gray-700']) }}>
        {{ $footer }}
    </footer>
</div>
```

Встроенные шаблоны
```php
php artisan make:component Alert --inline

public function render()
{
    return <<<'blade'
        <div class="alert alert-danger">
            {{ $slot }}
        </div>
    blade;
}
```

### Анонимные компоненты

Подобно встроенным компонентам, анонимные компоненты предоставляют механизм для управления компонентом через один файл. Однако анонимные компоненты используют один файл шаблона, но не имеют связанного с компонентом класса.

Чтобы определить анонимный компонент, вам нужно только разместить шаблон Blade в вашем каталоге resources/views/components. Например, если вы определили компонент в resources/views/components/alert.blade.php, вы можете просто отобразить его так

```html
<x-alert/>
```

Вы можете использовать символ ., чтобы указать, вложен ли компонент в каталоге components
```html
<x-inputs.button/>

<!--/resources/views/components/accordion/index.blade.php-->
<!--/resources/views/components/accordion/item.blade.php-->
<x-accordion>
    <x-accordion.item>
        ...
    </x-accordion.item>
</x-accordion>
```

Свойства / атрибуты данных
```php
@props(['type' => 'info', 'message'])

<div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
    {{ $message }}
</div>
```

Доступ к родительским данным
```php
<x-menu color="purple">
    <x-menu.item>...</x-menu.item>
    <x-menu.item>...</x-menu.item>
</x-menu>

<!-- /resources/views/components/menu/item.blade.php -->

@aware(['color' => 'gray'])

<li {{ $attributes->merge(['class' => 'text-'.$color.'-800']) }}>
    {{ $slot }}
</li>
```

### Динамические компоненты
```html
<x-dynamic-component :component="$componentName" class="mt-4" />
```


Самостоятельная регистрация компонентов

Вы должны зарегистрировать свои компоненты в методе boot поставщика служб вашего пакета

```php
Blade::component('package-alert', AlertComponent::class);
```

Автозагрузка компонентов пакета
```php
public function boot()
{
    Blade::componentNamespace('Nightshade\\Views\\Components', 'nightshade');
}

<x-nightshade::calendar />
<x-nightshade::color-picker />
```

## Формы
```html
@csrf

@method('PUT')

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

@error('email', 'login')
    <div class="alert alert-danger">{{ $message }}</div>
@enderro
```

## Стеки
```html
<head>
    <!-- Head Contents -->

    @stack('scripts')
</head>

@push('scripts')
    <script src="/example.js"></script>
@endpush

@prepend('scripts') В начало стека
    This will be first...
@endprepend
```

## Внедрение служб

Директива @inject используется для извлечения службы из контейнера служб Laravel. Первый аргумент, переданный в @inject, – это имя переменной, в которую будет помещена служба. Второй аргумент – это имя класса или интерфейса службы, которую вы хотите извлечь:

```html
@inject('metrics', 'App\Services\MetricsService')

<div>
    Monthly Revenue: {{ $metrics->monthlyRevenue() }}.
</div>
```

## Свои блейд дериктивы
```php
public function boot()
{
    Blade::directive('datetime', function ($expression) {
        return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
    });
}

Пользовательские обработчики вывода
public function boot()
{
    Blade::stringable(function (Money $money) {
        return $money->formatTo('en_GB');
    });
}

Пользовательские операторы If
public function boot()
{
    Blade::if('disk', function ($value) {
        return config('filesystems.default') === $value;
    });
}
@disk('local')
    <!-- The application is using the local disk... -->
@elsedisk('s3')
    <!-- The application is using the s3 disk... -->
@else
    <!-- The application is using some other disk... -->
@enddisk

@unlessdisk('local')
    <!-- The application is not using the local disk... -->
@enddisk
```
