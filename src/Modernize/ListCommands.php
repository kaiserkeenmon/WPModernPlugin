<?php

/**
 * Project: WPPluginModernizer
 * File: ListCommands.php
 * Author: Kaiser Keenmon
 * Date: 3/7/24
 */

namespace WPPluginModernizer\Modernize;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\ListCommand;

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
            '  _      _____  __  ___        __             ___  __          _    ',
            ' | | /| / / _ \/  |/  /__  ___/ /__ _______  / _ \/ /_ _____ _(_)__ ',
            ' | |/ |/ / ___/ /|_/ / _ \/ _  / -_) __/ _ \/ ___/ / // / _ `/ / _ \\',
            ' |__/|__/_/  /_/  /_/\___/\_,_/\__/_/ /_//_/_/  /_/\_,_/\_, /_/_//_/',
            '                                                       /___/        ',
            '',
        ]);

        $listCommand = new ListCommand();
        $listCommand->setApplication($this->getApplication());
        return $listCommand->run($input, $output);
    }
}

