<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Redbubble\BatchProcessorCommand;

$application = new Application();

$application->add(new BatchProcessorCommand);
$application->run();