<?php

/**
 * Test: Nette\DI\Resolver::autowireArguments()
 */

declare(strict_types=1);

use Nette\DI\Resolver;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


Assert::exception(function () {
	Resolver::autowireArguments(new ReflectionFunction(function (stdClass $x) {}), [], function () {});
}, Nette\DI\ServiceCreationException::class, 'Service of type stdClass needed by $x in {closure}%a?% not found. Did you add it to configuration file?');


Assert::exception(function () {
	Resolver::autowireArguments(new ReflectionFunction(function (Foo $x) {}), [], function () {});
}, Nette\DI\ServiceCreationException::class, "Class Foo needed by \$x in {closure}%a?% not found. Check type hint and 'use' statements.");


Assert::exception(function () {
	Resolver::autowireArguments(new ReflectionFunction(function ($x) {}), [], function () {});
}, Nette\DI\ServiceCreationException::class, 'Parameter $x in {closure}%a?% has no class type hint or default value, so its value must be specified.');


Assert::exception(function () {
	Resolver::autowireArguments(new ReflectionFunction(function (int $x) {}), [], function () {});
}, Nette\DI\ServiceCreationException::class, 'Parameter $x in {closure}%a?% has no class type hint or default value, so its value must be specified.');
