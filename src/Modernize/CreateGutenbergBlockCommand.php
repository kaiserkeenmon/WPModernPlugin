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
use Symfony\Component\Filesystem\Filesystem;
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
            ->setDescription('Scaffolds a basic Gutenberg block setup, including package installation and configuration.')
            ->setHelp('This command checks for npm installation and installs a sensible set of packages needed for Gutenberg block development.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Section for checking NPM installation
        $io->section('Checking for NPM installation...');
        $process = Process::fromShellCommandline('npm -v');
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error([
                'NPM is not installed. Please install NPM before running this command.',
                'For installation instructions, visit the official NPM website:',
                'https://docs.npmjs.com/downloading-and-installing-node-js-and-npm'
            ]);
            return Command::FAILURE;
        } else {
            $io->success('NPM is installed.');
        }

        // Install @wordpress/scripts
        $io->section('Installing @wordpress/scripts...');
        $process = Process::fromShellCommandline('npm install @wordpress/scripts --save-dev');
        $process->setWorkingDirectory(getcwd()); // Ensure we are in the plugin directory
        $process->setTimeout(240);
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error('An error occurred while installing @wordpress/scripts.');
            return Command::FAILURE;
        }
        $io->success('@wordpress/scripts installed successfully.');

        // Install additional npm packages required for webpack configuration
        $io->section('Installing additional NPM packages for webpack configuration...');
        $npmPackages = ['webpack-merge', 'style-loader', 'css-loader', 'sass-loader'];
        $process = Process::fromShellCommandline('npm install ' . implode(' ', $npmPackages) . ' --save-dev');
        $process->setWorkingDirectory(getcwd());
        $process->setTimeout(240);
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error('An error occurred while installing additional NPM packages.');
            return Command::FAILURE;
        }

        $io->success('Additional NPM packages installed successfully.');

        // Scaffold block files
        $io->section('Scaffolding block files...');
        $this->scaffoldBlocks($input, $output);

        return Command::SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function scaffoldBlocks(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $filesystem = new Filesystem();
        $blockNames = ['sample-block-1', 'sample-block-2'];

        // Load template contents
        $indexJsTemplatePath = getcwd() . '/src/Modernize/templates/Block/index.js';
        $editorScssTemplatePath = getcwd() . '/src/Modernize/templates/Block/editor.scss';
        $stylesScssTemplatePath = getcwd() . '/src/Modernize/templates/Block/styles.scss';

        $indexJsTemplate = file_get_contents($indexJsTemplatePath);
        $editorScssTemplate = file_get_contents($editorScssTemplatePath);
        $stylesScssTemplate = file_get_contents($stylesScssTemplatePath);

        foreach ($blockNames as $blockName) {
            $blockDirPath = getcwd() . "/src/blocks/$blockName";

            // Create the block directory if it doesn't exist
            if (!$filesystem->exists($blockDirPath)) {
                $filesystem->mkdir($blockDirPath);
                $io->success("Created directory: $blockDirPath");
            }

            // Populate the files with template content
            $filesystem->dumpFile("$blockDirPath/index.js", $indexJsTemplate);
            $filesystem->dumpFile("$blockDirPath/editor.scss", $editorScssTemplate);
            $filesystem->dumpFile("$blockDirPath/styles.scss", $stylesScssTemplate);

            $io->success("Scaffolded block files for $blockName");
        }

        return Command::SUCCESS;
    }
}
