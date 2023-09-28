# krono

Simple and basic time counter.

The main purpose of this counter is to get the eecution time of any task.

## Usage

Just instanciate Krono, then start it, stop it and get the elapsed time between those events :

```php

$krono = new Krono();
$start = $krono->start(); // returns a float value

// Your code to execute

$stop = $krono->stop(); // returns a float value
echo $krono->elapsedTime(); // returns difference between end and start

```
