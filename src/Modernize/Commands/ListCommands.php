<?php

/**
 * Project: WPPluginModernizer
 * File: ListCommands.php
 * Author: WPPluginModernizer
 * Date: 3/7/24
 */

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommands extends Command
{
    protected function configure()
    {
        $this
            ->setName('list-commands')
            ->setDescription('Displays the list of available commands.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Symfony\Component\Console\Exception\ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Display the ASCII logo
        $output->writeln([
            '  _      _____  ___  __          _      __  ___        __             _            ',
            ' | | /| / / _ \/ _ \/ /_ _____ _(_)__  /  |/  /__  ___/ /__ _______  (_)__ ___ ____',
            ' | |/ |/ / ___/ ___/ / // / _ `/ / _ \/ /|_/ / _ \/ _  / -_) __/ _ \/ /_ // -_) __/',
            ' |__/|__/_/  /_/  /_/\_,_/\_, /_/_//_/_/  /_/\___/\_,_/\__/_/ /_//_/_//__/\__/_/   ',
            '                         /___/                                                     ',
            ''
        ]);

        $listCommand = new ListCommand();
        $listCommand->setApplication($this->getApplication());
        return $listCommand->run($input, $output);
    }
}

