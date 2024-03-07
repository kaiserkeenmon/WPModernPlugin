<?php

/**
 * Project: WPModernPlugin
 * File: CreateGutenbergBlock.php
 * Author: Kaiser Keenmon
 * Date: 3/7/24
 */

namespace WPModernPlugin\Modernize;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class CreateGutenbergBlockCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('make:gutenberg-block')
            ->setDescription('Scaffolds a basic Gutenberg block setup, including installing npm and @wordpress/scripts.')
            ->setHelp('This command checks for npm installation and installs @wordpress/scripts to start Gutenberg block development.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Check for NPM
        $io->section('Checking for NPM installation...');
        $process = Process::fromShellCommandline('npm -v');
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error('NPM is not installed. Please install NPM before running this command.');
            return Command::FAILURE;
        } else {
            $io->success('NPM is installed.');
        }

        // Install @wordpress/scripts
        $io->section('Installing @wordpress/scripts...');
        $process = Process::fromShellCommandline('npm install @wordpress/scripts --save-dev');
        $process->setWorkingDirectory(getcwd()); // Ensure we are in the plugin directory
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error('An error occurred while installing @wordpress/scripts.');
            return Command::FAILURE;
        }

        $io->success('@wordpress/scripts installed successfully.');

        return Command::SUCCESS;
    }
}
