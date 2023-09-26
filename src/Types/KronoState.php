<?php

namespace Ascetik\Krono\Types;

interface KronoState extends Counter
{
    public function word(): string;
}
