# krono

Simple and basic time counter.

The main purpose of this counter is to get the eecution time of any task.

## Release notes

> Version 0.2.0

- Upgraded unitscale-time package, no breaking change here.

## Basic Usage

To instanciate Krono and use it simply :

```php

$krono = new Krono();
$start = $krono->start(); // Start point value

// Your code here, say it lasts 10ms

$stop = $krono->stop(); // stop point value

echo $krono->elapsedTime(); // prints a float value in seconds.

```

## Klock instance

This package uses ascetik/unitscale-time package. As there are many ways to get "now" value, we have to be sure to use a value in adapted proportion.

The **Klock** interface is a way to define "now" value and its base scale (minutes, seconds, milliseconds).
In this release, the only existing one uses system's high resolution time (hrtime).
This klock is the default klock used by Krono to get a "now" value with the right time unit (s, ms...).

Other Klocks will come soon...
You can build your own. It just has to implement the **Klock** interface of this package.

To regtister your own Klock :

```php

$krono = new Krono(new AnotherAvailableKlock());

```

Krono will use this Klock to define references and outputs.

## Basic usage

Krono behaviour may change along its usage.

At first, the krono is _waiting_ for start() command.

Any other call on krono will be unefficient :

- stop() does not stop anything and returns 0
- elapsedTime() returns 0 and value() returns a ScaleValue with 0 as amount.
- cancel() does not change anything

Use start() to start krono... The restart() command works the same way.

```php

$start = $krono->start();

```

At this step, Krono is _running_.
The value returned by start() method is the value of "now" depending on the **Klock** that is in use and registered as start point.
This time, behaviours have changed :

- start() just returns "now" value
- restart() resets krono and make it start again with refreshed "now" value.
- cancel() stops everything and brings Krono back to its initial state.
- Any attempt to get a result (using elapsedTIme() method, for example) will stop Krono and register call moment as end point.

To stop Krono, just use stop() method :

```php

$stop = $krono->stop();

```

\$stop contains another "now" value, registered as Krono end point.
This time, Krono is ready to display its outputs.

You can even _start_, _restart_ or _cancel_.
Method *stop()* will return end point value.

## Krono outputs

When Krono has stopped, you can retrieve informations about the elapsed time between start and end point values.

Get raw value using _elapsedTime()_ method.

You can also retrieve a **TimeScaleValue** with *value()* method and manipulate it :

```php

$value = $krono->value();
echo $value->raw(); // to print the elapsed time raw value (float, in seconds).
echo $value; // prints elapsed time prefixed with "s". Ex: 1.234s
echo $value->adjust(); // prints elapsed time adjusted to the highest possiblie scale. Ex : 0.3s adjusted to 300ms
echo $value->detail(); // prints a chain of different values with succeding scales : Ex : 1.123456s giving 1s 234ms 560μs

```
See unitscale-time README file for more informations.


## Some other commands

You can restart Krono at any time :

```php

$krono->start();

// Your code needs to restart

$krono->restart();
// and krono restarts with a new start time value.

// Some code again

$krono->stop();

```

You can cancel Krono.
Depending on its state, krono may behave a little differently :

```php

$krono = new Krono(); // on waiting state
$krono->cancel(); // nothing happens, krono is waiting for start command.

$krono->start(); // started Krono, running state
$krono->cancel(); // Krono reset, back to waiting state. Start value is lost

$krono->start(); // started Krono, running state
usleep(500);
$krono->stop(); // Krono with ready state
echo $krono->elapsedTime(); // prints task elapsedTime (float, seconds)
$krono->cancel(); // Krono reset, back to waiting state, start and stop values are lost
echo $krono->elapsedTime(); // prints 0

```

## Error/Exception

This tool does not throw any exception to avoid any problem for the user.
Anyway, if you have any problem, please post an issue on github.

## Next Release

More Klock implementations : the only existing one is a HighResolutionKlock using system's high resolution time (hrtime).
This Klock gives an instance of TimeScaleValue with "nano" base scale and converts it to seconds.
I'd like to create some other implementations using :
- DateTime
- microtime()
- time()
- any other ideas ?

Your choice would depend on the precision you need...

