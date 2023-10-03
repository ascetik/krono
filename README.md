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

## States

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

You can also retrieve a **TimeScaleValue** with *value()* method and manipulate it. See unitscale-time README file for more informations.


```php

echo $krono->value(); // prints the elapsed time with its unit (seconds, milliseconds...).
echo $krono->value()->adjust(); // prints the elapsed time decomposed in decreasing scales. Ex : 1s 33ms from 1033ms.

```

See *unitscale-time* package README file for more informations.

## Next Release


### Klock

More Klock implementations : the only existing one is a HighResolutionKlock using system's high resolution time (hrtime). This Klock gives an instance of TImeScaleValue
with "nano" base scale and converts it to seconds.
I'd like to have other implementations in seconds, milliseconds...

### Adjusting value

The only adjustment is the unitscale-time package's one, displaying detailed string value. Ex : 1s 33ms instead of 1033ms
I'd like to be able to adjust the value with a float result concatenated to its scale. Ex : 1.033s instead of 1033ms

### Krono elapsed time base value

I'm still not sure about base unit conversion to seconds. I think i should use the default Klock scale, not converted to seconds.

What if i'd like to have the full value of krono result and stay aware of its scale?
Anyway, adjustment have to return the same result.

## Known Issues

There are still some issues with unitscale-core package used by Krono inner system time calculation.

We shouldn't be able to change the returned TimeScaleValue base scale using "from" methods.

We should be able to adjust time in a simple way and use decomposed string output only if needed.

```
