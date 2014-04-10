<?php

namespace Experiments;

class Output
{
    
    public static function Write($String = '')
    {
        echo $String;
    }
    
    public static function MainHeader($String)
    {
        self::WriteLine(str_pad('', strlen($String), '='));
        self::WriteLine($String);
        self::WriteLine(str_pad('', strlen($String), '='));
        self::NewLine();
    }
    
    public static function Header($String)
    {
        self::WriteLine($String);
        self::WriteLine(str_pad('', strlen($String), '='));
    }
    
    public static function WriteLine($String = '')
    {
        self::Write($String);
        self::NewLine();
    }
    
    public static function WriteLines(array $Strings)
    {
        foreach ($Strings as $String) {
            self::WriteLine($String);
        }
    }
    
    public static function NewLine() {
        if(PHP_SAPI === 'cli') {
            echo PHP_EOL;
        }
        else {
            echo '<br />';
        }
    }
}

?>
