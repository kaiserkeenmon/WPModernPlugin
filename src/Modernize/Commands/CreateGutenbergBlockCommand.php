<?php

/**
 * Project: WPPluginModernizer
 * File: CreateGutenbergBlock.php
 * Author: WPPluginModernizer
 * Date: 3/7/24
 */

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use WPPluginModernizer\Modernize\Traits\Commands\PluginDirectory;

class CreateGutenbergBlockCommand extends Command
{
    use PluginDirectory;

    public function __construct() {
        parent::__construct();
        $this->initializePluginDirectory();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('make:gutenberg-block')
            ->setDescription('Scaffolds a basic Gutenberg block setup, including package installation and configuration (child only).')
            ->setHelp('This command checks for npm installation and installs a sensible set of packages needed for Gutenberg block development.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Enforce that this command is called from a child plugin
        try {
            $this->ensureCalledFromChildPlugin();
        } catch (\RuntimeException $e) {
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
            return Command::FAILURE;
        }

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
            $io->text($process->getErrorOutput());
            return Command::FAILURE;
        } else {
            $io->success('NPM is installed.');
        }

        // Create package.json
        $io->note('Creating a default package.json file.');
        $process = Process::fromShellCommandline('npm init -y');
        $process->setWorkingDirectory(getcwd());
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error('An error occurred while creating package.json.');
            $io->text($process->getErrorOutput());
            return Command::FAILURE;
        }
        $io->success('package.json created successfully.');

        // Install packages
        $npmPackages = [
            '@wordpress/scripts',
            '@wordpress/api-fetch',
            '@wordpress/blocks',
            '@wordpress/components',
            '@wordpress/element',
            'webpack-merge',
            'style-loader',
            'css-loader',
            'sass-loader'
        ];

        // Install npm packages
        $io->section('Installing NPM packages...');
        $packagesInstallCommand = 'npm install ' . implode(' ', $npmPackages) . ' --save-dev';
        $process = Process::fromShellCommandline($packagesInstallCommand);
        $process->setWorkingDirectory(getcwd()); // Ensure we are in the plugin directory
        $process->setTimeout(240);
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error('An error occurred while installing NPM packages.');
            $io->text($process->getErrorOutput());
            return Command::FAILURE;
        }
        $io->success('NPM packages installed successfully.');

        // Scaffold block files
        $io->section('Scaffolding block files...');
        $this->scaffoldBlocks($input, $output);

        // Copy over the block registration file
        $this->copyRegisterBlocksFile($io);

        return Command::SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function copyRegisterBlocksFile(SymfonyStyle $io) {
        $io->section('Creating registration-blocks.php file...');
        $registerBlocksTemplatePath = $this->parentPluginDirPath . '/src/Modernize/templates/Block/registration-blocks.php';
        $registerBlocksPath = $this->pluginDirPath . '/src/registration-blocks.php';

        try {
            // Check if the template file exists
            if (!file_exists($registerBlocksTemplatePath)) {
                throw new \RuntimeException("Template file does not exist: $registerBlocksTemplatePath");
            }

            $registerBlocksContents = file_get_contents($registerBlocksTemplatePath);

            $filesystem = new Filesystem();
            $filesystem->dumpFile($registerBlocksPath, $registerBlocksContents);

            $io->success("Created registration-blocks.php file at {$this->pluginDirName}/src/register-blocks.php");
        } catch (\RuntimeException $e) {
            $io->error("An error occurred: " . $e->getMessage());
            return Command::FAILURE;
        }
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
        $indexJsTemplatePath = $this->parentPluginDirPath . '/src/Modernize/templates/Block/index.js';
        $editorScssTemplatePath = $this->parentPluginDirPath . '/src/Modernize/templates/Block/editor.scss';
        $stylesScssTemplatePath = $this->parentPluginDirPath . '/src/Modernize/templates/Block/styles.scss';

        $indexJsTemplate = file_get_contents($indexJsTemplatePath);
        $editorScssTemplate = file_get_contents($editorScssTemplatePath);
        $stylesScssTemplate = file_get_contents($stylesScssTemplatePath);

        foreach ($blockNames as $blockName) {
            $blockDirPath = $this->pluginDirPath . "/src/blocks/$blockName";

            // Create the block directory if it doesn't exist
            if (!$filesystem->exists($blockDirPath)) {
                $filesystem->mkdir($blockDirPath);
                $io->success("Created directory: $this->pluginDirName/src/blocks/$blockName");
            }

            // Populate the files with template content
            $filesystem->dumpFile("$blockDirPath/index.js", $indexJsTemplate);
            $filesystem->dumpFile("$blockDirPath/editor.scss", $editorScssTemplate);
            $filesystem->dumpFile("$blockDirPath/styles.scss", $stylesScssTemplate);

            $io->success("Scaffolded block files for $blockName at $this->pluginDirName/src/blocks/$blockName");
            $io->note([
                "Customize the block files as needed.",
                "To build the block, run 'npm run build' in the plugin directory.",
            ]);
        }

        return Command::SUCCESS;
    }
}
