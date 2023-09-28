<?php

namespace Ascetik\Krono\Tools;

class Clock
{
    public static function systemResolution(bool $as_number = true)
    {
        return hrtime($as_number);
    }


}
