<?php

namespace Experiments;

abstract class Experiment
{
    const ExperimentType = __CLASS__;
    const ClassName = '{__CLASS__}';
    
    /**
     * @var string
     */
    private $Name;
    
    public function __construct($Name = self::ClassName)
    {
        $this->Name = str_replace(self::ClassName, Formatter::CamelCaseToWhitespace((new \ReflectionClass($this))->getShortName()), $Name);
    }
    
    /**
     * @return string
     */
    final public function GetName()
    {
        return $this->Name;
    }
    
    /**
     * @return array the output lines
     */
    final public function Run() {
        $Output = [];
        $this->Go($Output);
        
        return $Output;
    }
    protected abstract function Go(array &$Output);

}

?>
