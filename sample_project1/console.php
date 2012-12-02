<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$console = new Application();

$console
    ->register('hello')
    ->setDescription('あいさつをします')
    ->setCode(function(InputInterface $input, OutputInterface $output) {
        $output->writeln('Hello World');
    });

$console
    ->register('hello:yourname')
    ->setDescription('名前をつけてあいさつをします')
    ->addArgument('yourname', InputArgument::OPTIONAL, '名前', '馬野骨子')
    ->setCode(function(InputInterface $input, OutputInterface $output) {
        $output->writeln(sprintf('Hello, %s.', $input->getArgument('yourname')));
    });

$console
    ->register('hello:yourname2')
    ->setDescription('名前をつけてさいさつをします (オプション)')
    ->addOption('yourname', 'y', InputOption::VALUE_OPTIONAL, '名前', '馬野骨子')
    ->setCode(function(InputInterface $input, OutputInterface $output) {
        $output->writeln(sprintf('Hello, %s.', $input->getOption('yourname')));
    });

$console
    ->register('hello:dialog')
    ->setDescription('質問')
    ->setCode(function(InputInterface $input, OutputInterface $output) use ($console) {
        $dialog = $console->getHelperSet()->get('dialog');
        $name = $dialog->ask($output, '名前を教えて下さい。', '馬野骨子');
        $output->writeln(sprintf('Hello, %s.', $name));
    });

$console
    ->register('hello:everyone')
    ->setDescription('複数人の名前を呼びます')
    ->addArgument('names', InputArgument::IS_ARRAY, '名前', array('馬野骨子'))
    ->setCode(function(InputInterface $input, OutputInterface $output) {
        $names = $input->getArgument('names');
        $output->writeln(sprintf('Hello, %s.', implode($names, ', ')));
    });

$console
    ->register('sample:output')
    ->setDescription('出力のフォーマットを確認します')
    ->setCode(function(InputInterface $input, OutputInterface $output) use ($console) {
        $output->writeln('<info>情報</info>');
        $output->writeln('<error>エラー</error>');
        $output->writeln('<comment>コメント</comment>');
        $output->writeln('<question>質問</question>');

        $formatter = $console->getHelperSet()->get('formatter');
        $output->writeln($formatter->formatSection('セクション', 'メッセージ'));
        $output->writeln($formatter->formatBlock(array(
            'error',
            'the error error'
        ), 'error', true));

    });

$console->run();
