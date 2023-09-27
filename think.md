## KronoStates

il faut réfléchir aux actions possibles pour chaque State :

## Waiting

On peut :
- start() : oui, pour démarrer
- stop() : non, pas démarré
- reset() : non, pas démarré
- cancel() : non, pas démarré
- elapsedTime : 0 puisque non démarré

## Running

On peut :
- start() : non, déjà démarré       Exception
- stop() : oui
- reset() : oui
- cancel() : oui
- elapsedTime : on considère un appel stop() implicite -> on passe à ReadyState et on en retourne elapsedTime() via l'instance de krono

## Ready

- start : non -> Exception
- stop : non -> Exception
- cancel() : on repart sur un waiting
- reset() : cancel() et retourne krono->reset()
- elapsedTime :  la différence entre start et stop
