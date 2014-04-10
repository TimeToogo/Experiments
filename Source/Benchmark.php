<?php

namespace Experiments;

abstract class Benchmark extends Experiment
{
    protected $Iterations = 1;
    public function __construct($Name = self::ClassName)
    {
        parent::__construct('Benchmark - ' . $Name);
    }
    
    protected function Initialize($MethodName) {
        
    }
    
    final protected function Go(array &$Output)
    {
        $Reflection = new \ReflectionClass($this);
        $Methods = [];
        foreach ($Reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $Method) {
            /* @var $Mehod \ReflectionMethod */
            if(strpos($Method->name, '__') !== 0 && is_subclass_of($Method->getDeclaringClass()->name, __CLASS__)) {
                $Methods[$Method->getStartLine()] = $Method;
            }
        }
        ksort($Methods);
        
        $ReturnValue = null;
        foreach ($Methods as $Method) {
            $ReturnValue = $this->RunBenchmarkMethod($Output, $Method, $ReturnValue);
        }
    }
    
    private function RunBenchmarkMethod(array &$Output, \ReflectionMethod $Method, $PreviousReturnValue = null) 
    {
        $MethodName = $Method->name;
        $this->Initialize($MethodName);
        
        $Start = microtime(true);
        for ($Count = 0; $Count < $this->Iterations; $Count++) {
            $ReturnValue = $this->$MethodName($PreviousReturnValue);
        }
        $Time = microtime(true) - $Start;
        
        $Name = Formatter::CamelCaseToWhitespace($MethodName);
        $Output[] = $Name . ': ' . Formatter::Seconds($Time);
        
        
        return $ReturnValue;
    }
}

?>
