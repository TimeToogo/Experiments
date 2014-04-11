<?php

namespace Experiments;

abstract class Printer extends Experiment
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
        ob_start();
        $this->Output();
        $Output = array_merge($Output, explode(PHP_EOL, ob_get_contents()));
        ob_end_clean();
    }
    protected abstract function Output();
}

?>
