<?php

namespace Experiments\Tests;

/**
 * For array_mulisort to make sure keys are preserved
 */
class SerializeVsConcatenateArrayKeysAsString extends \Experiments\Benchmark
{
    private $Data;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->Iterations = 100;
        
        $this->Data = array_combine(
                array_map(function ($I) { return $I * (rand() / getrandmax()); }, range(1, 5000)), 
                array_reverse(range(1, 5000)));
    }
    
    public function Serialize()
    {
        $NewArray = [];
        foreach($this->Data as $Key => &$Value) {
            $NewArray[serialize($Key)] =& $Value;
        }
        
        return $NewArray;
    }
    
    public function Unserialize(array $SerializesArrayKeys)
    {
        $NewArray = [];
        foreach($SerializesArrayKeys as $Key => &$Value) {
            $NewArray[serialize($Key)] =& $Value;
        }
    }
    
    public function Concatenate()
    {
        $NewArray = [];
        foreach($this->Data as $Key => &$Value) {
            $NewArray['a' . $Key] =& $Value;
        }
        
        return $NewArray;
    }
    
    public function Unconcatenate($ConcatenatedArrayKeys)
    {
        $NewArray = [];
        foreach($ConcatenatedArrayKeys as $Key => &$Value) {
            $NewArray[substr($Key, 1)] =& $Value;
        }
        
        return $NewArray;
    }
}

?>
