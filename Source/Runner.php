<?php

namespace Experiments;

date_default_timezone_set('UTC');

define('EXPERIMENTS_ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('EXPERIMENTS_ROOT_NAMESPACE', __NAMESPACE__);
define('TESTS_DIR', __DIR__ . '/Tests/');

function ExperimentsAutoLoader($ClassName) {
    if(strpos($ClassName, EXPERIMENTS_ROOT_NAMESPACE . '\\') !== 0) {
        return;
    }
    
    $ClassName = substr($ClassName, strlen(EXPERIMENTS_ROOT_NAMESPACE) + 1);
    $FilePath = EXPERIMENTS_ROOT_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $ClassName) . '.php';
    if(file_exists($FilePath)) {
        require_once $FilePath;
    }
}

spl_autoload_register(__NAMESPACE__ . '\\ExperimentsAutoLoader');

$ExperimentFiles = [];
foreach ((new \DirectoryIterator(TESTS_DIR)) as $FileInfo) {
    /* @var $FileInfo \DirectoryIterator */
    if(!$FileInfo->isDir()) {
        $ExperimentFiles[$FileInfo->getRealPath()] = $FileInfo->getMTime();
        require TESTS_DIR . (string)$FileInfo; 
    }
}

$Experiments = [];
foreach (get_declared_classes() as $Class) {
    if(is_subclass_of($Class, Experiment::ExperimentType)) {
        $Reflection = new \ReflectionClass($Class);
        if($Reflection->isInstantiable() && isset($ExperimentFiles[$Reflection->getFileName()])) {
            $ModifiedTime = $ExperimentFiles[$Reflection->getFileName()];
            $Experiments[$Reflection->getFileName()] = new $Class();
        }
    }
}
//Alphabetical order
ksort($Experiments);

Output::MainHeader('- Begining PHP Experiments -');
Output::NewLine();
Output::NewLine();

$StartTime = microtime(true);

foreach($Experiments as $Experiment) {
    /* @var $Experiment Experiment */
    
    
    $ExperimentStartTime = microtime(true);
    $Output = $Experiment->Run();
    $ExperimentTime = microtime(true) - $ExperimentStartTime;
    
    Output::MainHeader($Experiment->GetName() . ' - ' . Formatter::Seconds($ExperimentTime));
    Output::WriteLines($Output);
    Output::NewLine();
    Output::NewLine();
    
    flush();
}

$TotalEndTime = microtime(true) - $StartTime;

Output::NewLine();
Output::MainHeader('- Finished PHP Experiments -');
Output::WriteLine(sprintf('Total time taken: %s', Formatter::Seconds($TotalEndTime)));

