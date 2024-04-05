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
        $filesystem = new Filesystem();

        // Section for checking NPM installation
        $io->section('Checking for NPM installation...');
        $this->checkNpmInstallation($io);

        // Create package.json
        $io->note('Creating a default package.json file.');
        $this->createPackageJson($io);

        // Update package.json with custom scripts
        $io->section('Updating package.json with custom scripts...');
        $this->updatePackageJsonScripts($input, $output);

        // Install packages
        $io->section('Installing NPM packages...');
        $this->installPackages($io);

        // Scaffold block files
        $io->section('Scaffolding block files...');
        $this->scaffoldBlocks($input, $output, $filesystem);

        // Copy over the block registration file
        $io->section('Copying registration-blocks.php file...');
        $this->copyRegisterBlocksFile($io, $filesystem);

        // Copy over webpack.config.js
        $io->section('Copying webpack.config.js file...');
        $this->copyWebpackConfigFile($io, $filesystem);

        return Command::SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function copyWebpackConfigFile(SymfonyStyle $io, Filesystem $filesystem) {
        // Define paths
        $sourceWebpackConfigPath = $this->parentPluginDirPath . '/src/Modernize/templates/Block/webpack.config.js';
        $destinationWebpackConfigPath = $this->pluginDirPath . '/webpack.config.js';

        // Attempt to copy the webpack.config.js file
        try {
            $filesystem->copy($sourceWebpackConfigPath, $destinationWebpackConfigPath, true); // The 'true' parameter overwrites the file if it already exists
            $io->success("webpack.config.js copied successfully to {$this->pluginDirPath}");
        } catch (IOExceptionInterface $exception) {
            $io->error('An error occurred while copying webpack.config.js: ' . $exception->getMessage());
            return Command::FAILURE;
        }

        // Continue with the rest of your scaffolding process...

        return Command::SUCCESS;
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function checkNpmInstallation(SymfonyStyle $io)
    {
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
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function createPackageJson(SymfonyStyle $io) {
        $process = Process::fromShellCommandline('npm init -y');
        $process->setWorkingDirectory(getcwd());
        $process->run();

        if (!$process->isSuccessful()) {
            $io->error('An error occurred while creating package.json.');
            $io->text($process->getErrorOutput());
            return Command::FAILURE;
        }
        $io->success('package.json created successfully.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param SymfonyStyle $io
     * @return int
     */
    protected function installPackages(SymfonyStyle $io) {
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
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function updatePackageJsonScripts(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $packageJsonPath = getcwd() . '/package.json';

        if (!file_exists($packageJsonPath)) {
            $io->error('package.json does not exist.');
            return Command::FAILURE;
        }

        // Load the existing package.json
        $packageJson = json_decode(file_get_contents($packageJsonPath), true);

        // Add or update the scripts
        $packageJson['scripts'] = [
            "start" => "wp-scripts start",
            "build" => "wp-scripts build"
        ];

        // Save the updated package.json
        if (file_put_contents($packageJsonPath, json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))) {
            $io->success('Updated package.json with custom scripts.');
        } else {
            $io->error('Failed to update package.json.');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function copyRegisterBlocksFile(SymfonyStyle $io, Filesystem $filesystem) {
        $io->section('Creating registration-blocks.php file...');
        $registerBlocksTemplatePath = $this->parentPluginDirPath . '/src/Modernize/templates/Block/registration-blocks.php';
        $registerBlocksPath = $this->pluginDirPath . '/src/registration-blocks.php';

        try {
            // Check if the template file exists
            if (!file_exists($registerBlocksTemplatePath)) {
                throw new \RuntimeException("Template file does not exist: $registerBlocksTemplatePath");
            }

            $registerBlocksContents = file_get_contents($registerBlocksTemplatePath);

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
    protected function scaffoldBlocks(InputInterface $input, OutputInterface $output, Filesystem $filesystem)
    {
        $io = new SymfonyStyle($input, $output);

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
