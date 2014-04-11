<?php

namespace Experiments\Tests;

function Func() {}

class FunctionReflectionInfo extends \Experiments\Printer
{
    public function Method() {}
    
    protected function Output()
    {
        echo 'Closure: ' . PHP_EOL;
        $this->DumpFunctionInfo(new \ReflectionFunction(function () { }));
        echo PHP_EOL;
        
        echo 'Method: ' . PHP_EOL;
        $this->DumpFunctionInfo(new \ReflectionMethod(__CLASS__, 'Method'));
        echo PHP_EOL;
        
        echo 'Function: ' . PHP_EOL;
        $this->DumpFunctionInfo(new \ReflectionFunction(__NAMESPACE__ . '\\Func'));
        echo PHP_EOL;
    }
    
    private function DumpFunctionInfo(\ReflectionFunctionAbstract $Reflection) 
    {
        $ReflectionClass = get_class($Reflection);
        $ReflectionCeption = new \ReflectionClass($ReflectionClass);
        foreach ($ReflectionCeption->getMethods(\ReflectionMethod::IS_PUBLIC) as $Method) {
            if(!$Method->isStatic() && $Method->getNumberOfParameters() === 0) {
                echo sprintf('%s::%s(): ', $ReflectionClass, $Method->name);
                
                try {
                    var_dump($Method->invoke($Reflection));
                }
                catch (\Exception $Exception) { echo 'Exception'; }
                echo PHP_EOL;
            }
        }
    }
}

?>
