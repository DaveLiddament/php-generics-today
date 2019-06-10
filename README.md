# PHP generics support

Many PHP developers would like generics supported by the language. 
Adding native support is non trivial and we might have to wait some time before it becomes part of the language.

Using modern static analysis tools as part of the development process it would be possible to get the benefit
of generics in PHP without language level support. Adding static analysis tools (that understand generics) to the CI 
process emulates the compile phase of compiled languages. Providing the tools can derive the types of all variables in the 
software it can reason that everything is correct and hence there is no need for type checking at run time.

Static analysis tools like [Psalm][psalm] and [Phan][phan] can do this analysis now. However there are differences
between how code needs to be annotated for both Psalm and Phan to work.

IDEs like [PhpStorm][phpstorm] can't yet do this analysis. Once standards for generics become 'approved' support will
follow.

For a more indepth discussion of the above read [PHP Generics today (almost)][https://www.daveliddament.co.uk/articles/php-generics-today-almost/].


## Goals 

The steps to achieve PHP generics support (using static analysis) are:

- Formalise 'standards' for generics. 
- Encourage tools (both IDEs and static analysis tools) to follow these standards.

The aim of this repo is to act as a starting point for formalising a standard that, at the very least,  he tool vendors 
would be happy to work towards. This should possibly form a new generics or static analysis PSR?
 
 
**NOTE:** If the term "standard" seems too strong then replace it with "widely agreed convention".

## Contents



## Format

The remainder of this file document proposes a format for generics. It is based on what current tools that understand
generics already do. 

This document builds on top of [PSR-5](https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md).

Some points are marked **Discussion point**. 


### Generics specification 




### Simple collections

To define the type of the value of an iterable use the format `<type>[]`. Where `<type>` is any primitive or object.

E.g. for strings `string[]` and for `User` objects: `User[]`.

See code below:

```php
/**
 * @return string[]
 */
function getNames(): array;
```

This convention is commonly applied. It is understood widely by both tools and coders.


This convention implies no knowledge of they type of the key of the collection. E.g. the type of `$id` is unknown in
this code:
```php
/**
 * @return string[]
 */
function getNames(): array { ... }

foreach(getNames() as $id => $name) { ... }
```


#### Simple collection in more depth

NOTE: the docblock is only defining the type of the collection values. The type of the collection is defined by the return type.

E.g. `getNames` returns an `array` with each element being on type `string`. Calling `count` on the output from `getNames` is valid.
```php
/**
 * @return string[]
 */
function getNames(): array { ... }

count(getNames()); // This is valid. 
```

In the next example an `iterable` is returned. Calling `count` is not valid as an `iterable` is not `Countable`.
```php
/**
 * @return string[]
 */
function getNames(): iterable { ... }

count(getNames()); // Not valid
```


**Discussion point**

In the case that no return type is specified the only safe thing to do is assume a return type of `iterable`.
So again the call to count would not be valid:

```php
/**
 * @return string[]
 */
function getNames()

count(getNames()); // Not valid
```






### Alternative methods of specifying value type of a collection.

Additionally : `array<type>`. As with simple collections `type` is any primitive type or object.

E.g. `array<string>` is considered the same as `string[]`.

This convention implies no knowledge of they type of the key of the iterable.



**Discussion what happens when docblock and actual definition are out of step**

Should any of this be enforced...

When both docblock and parameter or return type are specified but differ the docblock takes precedence. 
The docblock must be compatible. 

E.g. The is OK as `array` is in `iterable`. `$users` should be treated as an array of `User` objects. 
```php
/**
 * @return array<User>
 */
function getUsers(): iterable { ... }

$users = getUsers();
```

This is not acceptable because an `iterable` is not in all cases an `array`:
```php
/**
 * @return iterable<User>
 */
function getUsers(): array { ... }
```


Example with parameters. This is acceptable, docblock states an `array` is required but function only requires `iterable`: 
```php
/**
 * @param array<User> $users
 */
function addUsers(iterable $users): void { ... }
```

But this is not allowed:
```php
/**
 * @param iterable<User> $users
 */
function addUsers(array $users): void { ... }
```





### Specify key and value types in collections

To give information about the type of the key and value in a collection use the format `array<TKey, TValue>`.
 Where `TKey` is one of `string` or `int` and `TValue` can be any primitive or object. 
 
In the code below the type of both `$name` and `$user` is known.
```php
/**
 * @return array<string, User>
 */
function getUsers(): array;

foreach(getUsers() as $name => $user) { ... }
```


**Discussion point**

What should happen if the case where there is a mismatch between docblock and return type. E.g. 

```php
/**
 * @return iterable<string, Foo>
 */
function getFoos(): array { ... }
```


### Templates (functions)

Consider this somewhat pointless function. The return type is the same type of the parameter `$value`. 
In the code snippet `$output` is is of type `Foo`.

```php
/**
 * @template T
 * @param T $value
 * @return T
 */
function mirror($value) { return $value; }

$output = mirror(new Foo());
```


A slightly more advanced and useful function for returning the first item in the collection.
In the sample code `$firstInt` is of type `int`:

```php
/**
 * @template T
 * @param T[] $values
 * @return T
 */
function first(iterable $values) { ... }

$firstInt = first([1, 2, 3, 4]); 
```


### Templates (classes)

Also possible to provide a template for a class:

```php
/**
 * @template T
 */
class Stack 
{
    /**
     * @param T $item
     */
    public function push($item): { ... }

    /**
     * @return T
     */    
    public function pop() { ... }
}
```

When instantiating a class the type must be specified. E.g. creating a stack that only contains ints.

```php
/** @var Stack<int> $stack */
$stack = new Stack();
```

A class or interface can have multiple templated values. E.g.:

```php
/**
 * @template TKey
 * @template TValue
 */
interface Map 
{
    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function add($key, $value): void;
    
    /**
     * @param TKey $key
     * @return TValue
     */
    public function get($key);
}
```

### Template constraints 

Templates can be constrained to a type, e.g. `@tempalte T of object` means T must be an `object`. 

E.g. 
```php

/**
 * @template T
 * @param T of object
 * @return T[]
 */
function asArray($item): array { return [$item]; }

$users = asArray(new User()); // Valid as User is an object
$integers = asArray(1); // Not allowed, int is not an object
```


It is also possible to contraint to a type of object, e.g. `@template T of Animal` means T must be `Animal` or something
that extends `Animal`.

E.g. 
```php
class Animal {}
class Dog extends Animal {}
class Person {}

/**
 * @template T of Animal
 * @param T $item
 * @return T[]
 */
function asArray($item):array {
  return [$item];
} 

asArray(new Animal()); // OK
asArray(new Dog());    // OK
asArray(new Person()); // Not OK Person is not an Animal
```

### Extending templates




### class-string type

The `class-string` type


### Assertions 

**Discussion point**

Although not technically part of generics assertions will probably be required 



## Validation


## Stubs




[psalm]: https://psalm.dev/
[phpstan]: https://github.com/phpstan/phpstan
[phan]: https://github.com/phan/phan
[phpstorm]: https://www.jetbrains.com/phpstorm/
