<?php

namespace Ascetik\Krono;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\UnitscaleTime\Factories\TimeScaler;

class Krono
{
    private float $start = 0;
    private float $stop = 0;
    private bool $isConsumed = false;
    private bool $isRunning = false;

    public function start()
    {
        if ($this->isRunning) {
            throw new KronoException('already running');
        }
        $this->start = hrtime();
        $this->isRunning = true;
        return $this->start;
    }

    public function stop()
    {
        if (!$this->isRunning) {
            throw new KronoException('not started');
        }
        $this->stop = hrtime();
        $this->isRunning = false;
        return $this->stop;
    }

    public function elapsedTime(): float
    {
        return $this->stop - $this->start;
    }

    public function __toString()
    {
        $time = $this->elapsedTime();
        $unit = TimeScaler::unit($time);
        return (string) $unit;
    }
    /**
     * J'ai un chrono pas encore lancé.
     * je ne peux pas stopper ni afficher de résultat, ni cancel.
     * Je peux faire reset mais ça ne sert à rien, j'y suis déjà.
     * InitialState
     * Je le lance avec start()
     * à ce moment là, je ne dois pouvoir faire que stop(), restart() et cancel()
     * je ne peux pas demander de sortie
     * RunningState
     * je ne peux restart(), stop(), cancel() qu'en RunningState
     * Si j'ai fait restart, je réinitialise mes valeurs et je rappelle start()
     * si j'ai fait cancel(), je reprends l'état du début
     * InitialState
     * ensuite je fais stop(). là je peux faire reset() ou obtenir mon résultat, float ou string. Je ne peux pas cancel()
     * ReadyState
     *
     */
}
