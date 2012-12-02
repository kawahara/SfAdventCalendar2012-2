<?php

namespace Bucyou\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SampleCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('bucyou:sample')
            ->setDescription('Hello');
            // ->addArgument(..
            // ->addOption(..
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Hello</info>');
    }
}
