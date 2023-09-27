<?php

namespace Ascetik\Krono;

use Ascetik\Krono\States\WaitingState;
use Ascetik\Krono\Types\Counter;
use Ascetik\Krono\Types\KronoState;
use Ascetik\UnitscaleTime\Factories\TimeScaler;

class Krono implements Counter
{
    private KronoState $state;

    public function __construct()
    {
        $this->reset();
    }

    public function setState(KronoState $state):self
    {
        $this->state = $state;
        return $this;
    }

    public function start(): float
    {
        return $this->state->start();
    }

    public function stop(): float
    {
        return $this->state->stop();
    }

    public function cancel(): void
    {
        $this->state->cancel();
    }

    public function restart(): float
    {
        return $this->state->restart();
    }

    public function reset()
    {
        $this->state = new WaitingState($this);
    }

    public function elapsedTime(): float
    {
        return $this->state->elapsedTime();
    }

    public function __toString()
    {
        $time = $this->elapsedTime();
        $unit = TimeScaler::unit($time);
        return (string) $unit;
    }

    public function state():string
    {
        return $this->state::WORDING;
    }
    /**
     * J'ai un chrono pas encore lancé.
     * je ne peux pas stopper ni afficher de résultat, ni cancel.
     * Je peux faire reset mais ça ne sert à rien, j'y suis déjà.
     * WaitingState
     * Je le lance avec start()
     * à ce moment là, je ne dois pouvoir faire que stop(), restart() et cancel()
     * je ne peux pas demander de sortie
     * RunningState
     * je ne peux restart(), stop(), cancel() qu'en RunningState
     * Si j'ai fait restart, je réinitialise mes valeurs et je rappelle start()
     * si j'ai fait cancel(), je reprends l'état du début
     * WaitingState
     * ensuite je fais stop(). là je peux faire restart() ou obtenir mon résultat, float ou string. Je ne peux pas cancel()
     * ReadyState
     *
     */
}