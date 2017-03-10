# About hydrating

This package aims to help handling raw data (array of basic types) for editing and creating instances of
whatever-the-class-you-want.
Therefore, a class offering a solution to this purpose should implement interface `Hydrator`, ie methods `hydrateObject`
and `hydrateNewObject`.
- method `create` should create an instance of requested class, using parsed data to set its fields.
- method `apply` should edit a parameter object, setting its properties using parsed data.
This package offers a generic  implementation of `Hydrator`, `BooyaHydrator`, designed to work specifically with
[Mouf](http://mouf-php.com/).

## How to use?

The main interest of this package is to avoid unpleasant and interminable hours of writing repetitive lines of code, and
instead make the creation of a handler a simple configuration task. Configuration, or should I use the terms "dependency
injection". This is where the power of Mouf comes particularly handy: this tool, featuring present library, will allow
you to create your form parsers/validators with only drag/drop/naming action, occasionally writing little pieces of code
(if you wish to implement you own atomic parsers or validators), but without duplication.

## How does it work?

### Data parsing

Class `BooyaHydrator` uses instances of `FieldHandlerInterface` to parse and validate raw input. Such an instance should
parse specific key(s) in input array (using a configured instance of `ParserInterface`), and may throw an exception
(`Invalid`).
In `FieldHandler` implementation of `FieldHandlerInterface`, validation is performed after all input data has been parsed
(even if parsing errors have occurred), and is performed on parsed data, not on raw inputs. You will probably need to keep
that in mind in order to get your types right.

### Data validation

An implementation of interface `ValidatorInterface` must implement method `validate`; this method will do nothing if input
data is correct, and shall throw a `InvalidValueException` if it is not. Such an exception needs an `innerErrorsMap` when
constructed. A well-formed errors map should be an associative array, keys being strings, and values each being either a
`FieldError` (composed of an error string, and a details string) or a well-formed errors map. More precisely, its structure
should be consistent with input data, where invalid fields would be replaced by `FieldError` instances.
values are replaced by 

### Applying parsed data

Using an hydrator (by default, TDBMHydrator seems to be a good choice), the parsed data can finally be used in two
different ways: You can whether apply it to an already existing object, (using implementation of method `hydrateObject`)
of your hydrator, or create a new instance of the class you wish to instanciate (method `hydrateNewObject`).
