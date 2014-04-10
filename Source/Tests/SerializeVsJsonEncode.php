<?php

namespace Experiments\Tests;

class SerializeVsJsonEncode extends \Experiments\Benchmark
{
    private $Data;
    
    public function __construct()
    {
        parent::__construct();
        $this->Iterations = 1000;
        
        $this->Data = range(1, 100) + array_map('str_shuffle', array_fill_keys(range(101, 200), '1234567890-qwertyuiopasdfghjklzxcvbnm'));
        shuffle($this->Data);
    }
    
    public function Serialize()
    {
        serialize($this->Data);
    }
    
    public function JsonEncode()
    {
        json_encode($this->Data);
    }
}

?>
