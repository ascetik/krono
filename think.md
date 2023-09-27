## KronoStates

il faut réfléchir aux actions possibles pour chaque State :

## Waiting

On peut :
- start() : oui, pour démarrer
- stop() : non, pas démarré
- restart() : non, pas démarré
- cancel() : non, pas démarré
- elapsedTime : 0 puisque non démarré

## Running

On peut :
- start() : non, déjà démarré       Exception
- stop() : oui
- restart() : oui
- cancel() : oui
- elapsedTime : on considère un appel stop() implicite -> on passe à ReadyState et on en retourne elapsedTime() via l'instance de krono

## Ready

- start : Oui, on repart en running en perdant les résultats passés
- stop : non -> Exception
- cancel() : on repart sur un waiting
- restart() : cancel() et retourne krono->restart()
- elapsedTime :  la différence entre start et stop

je ne me pose pas les bonnes questions.
Quand on a fini. On pourrait vouloir réutiliser krono pour dd'autres opérations.
On pourrait mettre un reset() sur krono pour le réinitialiser.
Il se remettrait lui-même tout seul en waiting.

Quand on est ready et qu'on rappelle start(), il faut faire comme si on réutilisait le krono en lui rendant RunningState avec le hrtime().
finalement c'etait pas plus mal que le State se démerde avec sa valeur...
