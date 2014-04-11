<?php

namespace Experiments\Tests;

class ClosureReflectionInfo extends \Experiments\Printer
{
    protected function Output()
    {
        $Closure = function () { };
        
        $Reflection = new \ReflectionFunction($Closure);
        
        $ReflectionClass = get_class($Reflection);
        $ReflectionCeption = new \ReflectionClass($ReflectionClass);
        foreach ($ReflectionCeption->getMethods(\ReflectionMethod::IS_PUBLIC) as $Method) {
            if(!$Method->isStatic() && $Method->getNumberOfParameters() === 0) {
                echo sprintf('%s::%s(): ', $ReflectionClass, $Method->name);
                var_dump($Method->invoke($Reflection));
                echo PHP_EOL;
            }
        }
    }
}

?>
