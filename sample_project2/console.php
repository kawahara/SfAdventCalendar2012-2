<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Bucyou\Command\SampleCommand;

$console = new Application();
$console->add(new SampleCommand());
$console->run();
