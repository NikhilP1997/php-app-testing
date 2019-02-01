[![Build Status](https://travis-ci.org/edonosotti/php-functional-tests-sample-app.svg?branch=master)](https://travis-ci.org/edonosotti/php-functional-tests-sample-app)

# Using PHP Built-in Server to run automated testing

## Description

`phpunit` is widely used to unit-test `PHP` code, but using the `PHP` built-in
server, it can be used to run *functional* tests
(see [#20 here](https://www.softwaretestinghelp.com/types-of-software-testing/))
to verify that your application is behaving as expected and that the rendered
output is correct.

### Included tests

 * [`test/StaticPagesTest.php`](test/StaticPagesTest.php)
   Test for static `HTML` pages
 * [`test/DynamicPagesTest.php`](test/DynamicPagesTest.php)
   Test for dynamic `PHP` pages
 * [`test/RoutesTest.php`](test/RoutesTest.php)
   Test for dynamically routed pages

## Requirements

 * [`PHP 7.x`](http://php.net)
 * [`Composer`](https://getcomposer.org)

## Installation

Clone the repository, then run:

```
$ composer install
```

## Usage

### Simulate *passing* tests

Run:

```
$ ./vendor/bin/phpunit
```

### Simulate *errors*

Remove the `.skip_this` extension from:

 * [`www/not_valid.html.skip_this`](www/not_valid.html.skip_this)
 * [`www/code_error.php.skip_this`](www/code_error.php.skip_this)

then run:

```
$ ./vendor/bin/phpunit
```
