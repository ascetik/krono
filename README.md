# krono

Simple and basic time counter.

The main purpose of this counter is to get the eecution time of any task.

## Basic Usage

To instanciate Krono and use it simply :

```php

$krono = new Krono();
$start = $krono->start(); // Start point value

// Your code here, say it lasts 10ms

$stop = $krono->stop(); // stop point value

echo $krono->elapsedTime(); // prints the difference between stop and start values
echo $krono; // prints the elapsed time as string with a chain of time units

```

At this step, Krono is just able to start. Any other action throws a KronoException.
The elapsed time stays to zero.

Start it :

```php

$start = $krono->start(); // returns a float value

```
The method start() registers a value representing "now" as start point and returns it.


Now Krono is able to cancel, restart or stop :
- Cancelation sets Krono back to previous state.
- Restart will stop Krono and start it again with refreshed time reference.

Trying to start again just returns the start point value.

When Krono has started, put the code you want the execution elapsed time from.

Stopping Krono registers a value representing "now" as end point and returns it.

```php

$stop = $krono->stop(); // returns a float value

```
, then start it, stop it and get the elapsed time between those events :
Restart is possible.
Krono is Stringable. You can even get a string representing this elapsed time :

```php
echo $krono->elapsedTime(); // returns difference between end and start
$krono->


```
