<?php

namespace Experiments;

class Formatter
{
    public static function Seconds($Double, $Precision = 3)
    {
        return number_format($Double, $Precision) . 's';
    }
    
    public static function CamelCaseToWhitespace($String)
    {
        return implode(' ', preg_split('/(?=[A-Z])/', $String));
    }
}

?>
