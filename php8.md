Именованные аргументы

```php
$arr = [1,3,2];
$sorted_array = sort(array:$arr, flags:SORT_NUMERIC);
```

Аннотации/Атрибуты (Attributes)

```php

```

Объявление свойств в конструкторе

```php
    class Book{
        public function __construct(
            public string $title = '',
            protected int $age = 0,
        ) {
        
        }
    }
```

Объеденение типов

Типы полей класса инвариантны, и не могут быть изменены при наследовании.
А вот с методами всё немного интересней:

    Параметры методов можно расширить, но нельзя сузить.
    Возвращаемые типы можно сузить, но нельзя расширить.

Интереснее становится когда strict_types установлен в 0, то есть по умолчанию. Например, функция принимает int|string, а мы передали ей bool. Что в результате должно быть в переменной? Пустая строка, или ноль? Есть набор правил, по которым будет производиться приведение типов.

Так, если переданный тип не является частью объединения, то действуют следующие приоритеты:

    int;
    float;
    string;
    bool;


```php
    class Book{
        public function __construct(
            public string|int $price = '',
        ) {
        
        }
    }
```

Оператор выбора match

```php
$v = 1;
echo match ($v) {
    0 => 'Foo',
    1 => 'Bar',
    2 => 'Baz',
}; 
```

Оператор безопасного null

```php
 $session?->user?->getAddress()?->country;
```

Изменение приведения строки к числу

| Comparison    | Before | After |
|---------------|--------|-------|
| 0 == "0"      | true   | true  |
| 0 == "0.0"    | true   | true  |
| 0 == "foo"    | true   | false |
| 0 == ""       | true   | false |
| 42 == " 42"   | true   | true  |
| 42 == "42foo" | true   | false |

Новые функции для работы со строками (str_contains, str_starts_with, str_ends_with)

Функция str_contains проверяет, содержит ли строка $haystack строку $needle Функция str_starts_with проверяет,
начинается ли строка $haystack строкой $needle Функция str_ends_with проверяет, кончается ли строка $haystack строкой
$needle

```php
str_contains("abc", "a"); // true
str_starts_with($str, "beg")
str_ends_with($str, "End")
```

Использование ::class на объектах

```php
$object = new stdClass;
var_dump($object::class); // "stdClass"
```

Возвращаемый тип static ип static был добавлен для более явного указания, что используется позднее статическое
связывание (Late Static Binding) при возвращении результата

```php
class Foo {
    public static function createFromWhatever(...$whatever): static {
        return new static(...$whatever);
    }
}

//Также, для возвращения $this, стоит указывать static вместо self
abstract class Bar {
    public function doWhatever(): static {
        // Do whatever.
        return $this;
    }
}
```

Weak Map Это специальная структура данных для хранения значений, ключами которых являются объекты, в основном
используемая для кеширования. Особенностью есть то, что объекты, используемые как ключи, подвержены сборке мусора.
Поэтому, WeakMaps особенно пригодны для долгоживущих процессов.

```php
WeakMap implements Countable , ArrayAccess , Iterator {
    public __construct ( )
    public count ( ) : int
    public current ( ) : mixed
    public key ( ) : object
    public next ( ) : void
    public offsetExists ( object $object ) : bool
    public offsetGet ( object $object ) : mixed
    public offsetSet ( object $object , mixed $value ) : void
    public offsetUnset ( object $object ) : void
    public rewind ( ) : void
    public valid ( ) : bool
}

class FooBar {
    private WeakMap $cache;

    public function getSomethingWithCaching(object $obj) {
        return $this->cache[$obj] ??= $this->decorated->getSomething($obj);
    }

    // ...
}
```

Возможность оставить запятую в конце списка параметров

```php
public function whatever(
    string $s,
    float $f, // Allowed
) {
    // ...
}
```

Объекты, которые реализуют метод __toString, неявно реализуют этот интерфейс. Сделано это в большей мере для гарантии типобезопасности. С приходом union-типов, можно писать string|Stringable, что буквально означает "строка" или "объект, который можно преобразовать в строку". В таком случае, объект будет преобразован в строку только когда уже не будет куда оттягивать.

Возможность опустить переменную исключения (non-capturing catches)

Валидация абстрактных методов в трейтах (Validation for abstract trait methods)
```php
trait MyTrait {
    abstract private function neededByTheTrait(): string;

    public function doSomething() {
        return strlen($this->neededByTheTrait());
    }
}
```
