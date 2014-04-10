<?php

namespace Experiments\Tests;

class ArrayKeyCasting extends \Experiments\Printer
{
    protected function Output()
    {
        $Array = [
            'foo' => true,
            5 => true,
            4.322 => true,
            true => true,
            null => true
        ];
        
        var_dump($Array);
    }
}

?>
