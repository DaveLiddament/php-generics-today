# PHP generics support

Many PHP developers would like generics supported by the language. 
Adding native support is non trivial and we might have to wait some time before it becomes part of the language.

There is another way though...

Using modern static analysis tools as part of the development process it would be possible to get the benefit
of generics in PHP without language level support. Using static analysis tools (that understand generics) to the build
process can emulate the compile phase of compiled languages. Providing the tools can derive the types of all variables 
in the software they can reason that everything is correct (including generics) and hence there is no need for type 
checking at run time.

Static analysis tools like [Psalm][psalm] and [Phan][phan] can do this analysis now. 
The extra information required by the static analysis tools to understand generics is captured in docblocks.
However there are differences between how code needs to be annotated for both Psalm and Phan to work.

IDEs like [PhpStorm][phpstorm] can't yet do this analysis. Once standards for generics become 'approved' support will
follow.

For a more indepth discussion of the above read [PHP Generics today (almost)][https://www.daveliddament.co.uk/articles/php-generics-today-almost/].


## Goals 

THe purpose of this repo is to act as a central point to start the discussion around the steps required to get 
static analysis supported generics mainstream to those who want it.

The steps required are:

- Formalise conventions for generics. 
- Encourage tools (both IDEs and static analysis tools) to follow these standards.

The aim of this repo is to act as a starting point for formalising a standard that, at the very least, the tool vendors 
would be happy to work towards. This should possibly form a new generics or static analysis PSR?
  
**NOTE 1:** If the term "standard" seems too strong then replace it with "widely agreed convention".


## Contents

#### [Generics conventions](GenericsConventions.md) 

This outlines the current conventions for generics that are understood by static analysers. 


#### [Improving interoperability between static analysers](ImprovingInteroperability.md)

Suggestions for improving interoperability between various static analysis tools.


#### [Code snippets](examples/src)

See the examples/src directory for a set of code snippets that test the static analysers suitability for being used
for generics. 

This is currently work in progress.


#### Tool to compare output from static analysers with expected results

Coming soon...


## TODO

- [ ] Missing sections in the generics conventions section
- [ ] Add more code samples
- [ ] Create a tool to compare outputs from Static Analysis tools with the expected results in the code samples 
- [ ] Contributing code samples doc




[psalm]: https://psalm.dev/
[phpstan]: https://github.com/phpstan/phpstan
[phan]: https://github.com/phan/phan
[phpstorm]: https://www.jetbrains.com/phpstorm/
