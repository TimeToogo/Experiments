<?php

namespace Experiments\Tests;

class ExceptionVsDebugBacktrace extends \Experiments\Benchmark
{
    public function __construct()
    {
        parent::__construct();
        
        $this->Iterations = 20000;
    }
    
    public function DebugBacktrace()
    {
        debug_backtrace();
    }
    
    public function Exception()
    {
        try {
            throw new \Exception();
        } 
        catch (\Exception $Exception) {
            $Exception->getTrace();
        }
    }
}

?>
