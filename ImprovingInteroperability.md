# Improving interoperability between existing static analysis tools


There are a number of fantastic PHP static analysis tools (e.g. [Psalm][psalm], [Phan](phan), [PHPStan](phpstan)).
In many cases they have the same or similar functionality, however each tool has their own customer annotations. 

See this [PHPUnit PR](https://github.com/sebastianbergmann/phpunit/pull/3708), it adds support for Psalm, probably Phan 
would work too if a cross tool annotation was used. 

It would be great if there there is a static analyser prefix annotation. E.g. `@static-analyser-`.

Where tools are consistent with one another they can also provide an `@static-analyser-` version of the annotation.

For example currently Psalm and Phan both allow tool specific prefixes doclock annotations (e.g. `@param`).

E.g.
```php
/**
 * @psalm-param array<string, User> $users
 * @phan-param array<string, User> $users
 */
function greetUsers(array $users): void
```

In this case it would be safe to also have:
```php
/**
 * @static-analyser-param array<string, User> $users
 */
function greetUsers(array $users): void
```

So these are all the interpreted in the same way to Psalm:
```php
@param
@psalm-param
@static-analyser-param
```

So these are all the interpreted in the same way to Phan:
```php
@param
@phan-param
@static-analyser-param
```

Where there are behaviour diverges between tools (i.e. how Psalm and Phan annotate extending templates) then use of 
the `@static-analyser-` would not be appropriate.





[psalm]: https://psalm.dev/
[phpstan]: https://github.com/phpstan/phpstan
[phan]: https://github.com/phan/phan
[phpstorm]: https://www.jetbrains.com/phpstorm/
