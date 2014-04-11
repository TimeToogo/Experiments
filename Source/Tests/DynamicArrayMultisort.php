<?php

namespace Experiments\Tests;

class DynamicArrayMultisort extends \Experiments\Printer
{
    protected function Output()
    {
        $Data = [
                ['volume' => 67, 'edition' => 2],
                ['volume' => 86, 'edition' => 1],
                ['volume' => 85, 'edition' => 6],
                ['volume' => 98, 'edition' => 2],
                ['volume' => 86, 'edition' => 6],
                ['volume' => 67, 'edition' => 7]
        ];
        
        $Volumes = [];
        $Editions = [];
        foreach ($Data as $key => $row) {
            $Volumes[$key]  = $row['volume'];
            $Editions[$key] = $row['edition'];
        }
        
        $Arguments = [];
        
        $Arguments[] =& $Volumes;
        $Arguments[] = SORT_DESC;
        $Arguments[] = SORT_REGULAR;
        
        $Arguments[] =& $Editions;
        $Arguments[] = SORT_DESC;
        $Arguments[] = SORT_REGULAR;
        
        $Arguments[] =& $Data;
        
        echo 'Original: ';
        var_dump($Data);
        echo PHP_EOL;
        
        call_user_func_array('array_multisort', $Arguments);
        
        echo 'Sorted: ';
        var_dump($Data);
    }
}

?>
