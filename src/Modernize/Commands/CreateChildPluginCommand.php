<?php

/**
 * Project: WPPluginModernizer
 * File: CreateChildPluginCommand.php
 * Author: Kaiser Keenmon
 * Date: 3/26/24
 */

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use WPPluginModernizer\Modernize\Traits\Commands\PluginDirectory;
use WPPluginModernizer\Modernize\Utilities\Strings;

class CreateChildPluginCommand extends Command
{
    use PluginDirectory;

    protected $composerDependencies;

    protected $nameSpaceName;

    public function __construct()
    {
        parent::__construct();
        $this->initializePluginDirectory();
        $this->composerDependencies = [
            'autoload' => [
                'psr-4' => [
                    "{$this->nameSpaceName}\\" => "src/"
                ]
            ],
            'require' => [
                "symfony/console" => "^7.0",
                "symfony/filesystem" => "^7.0",
                "symfony/process" => "^7.0",
                "symfony/finder" => "^7.0",
                "symfony/string" => "^7.0"
            ]
        ];
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('make:child-plugin')
            ->setDescription('Creates a new plugin from the template (parent only).')
            ->setHelp('This command allows you to create a new WordPress plugin from a template')
            ->addArgument('pluginName', InputArgument::REQUIRED, 'The name of the new plugin');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Enforce that this command is called from the parent plugin
        try {
            $this->ensureCalledFromParentPlugin();
        } catch (\RuntimeException $e) {
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
            return Command::FAILURE;
        }

        $io = new SymfonyStyle($input, $output);

        $pluginName = $input->getArgument('pluginName');
        $pluginName = Strings::sanitizeTitleWithDashes($pluginName);
        $this->nameSpaceName = Strings::sanitizeAndConvertToCamelCase($pluginName);
        $targetDir = dirname($this->pluginDirPath) . '/' . $pluginName;

        $filesystem = new Filesystem();

        // Check if the plugin directory already exists
        if ($filesystem->exists($targetDir)) {
            $output->writeln('<error>A plugin with this name already exists.</error>');
            return Command::FAILURE; // Use a constant or a specific integer to indicate failure
        }

        try {
            // Copy the ChildPlugin skeleton to the new location
            $sourceDir = $this->pluginDirPath . '/src/Modernize/templates/ChildPlugin/';
            $filesystem->mirror($sourceDir, $targetDir);

            // Set modernize to be executable
            $modernizeScriptPath = $targetDir . '/modernize';
            if (file_exists($modernizeScriptPath)) {
                chmod($modernizeScriptPath, 0755); // Make the script executable
                $output->writeln('<info>modernize script set to executable.</info>');
            }

            // Rename the main plugin file
            $originalPluginFileName = 'child-plugin.php';
            $newPluginFileName = $pluginName . '.php';
            $filesystem->rename($targetDir . '/' . $originalPluginFileName, $targetDir . '/' . $newPluginFileName);

            // Update the plugin header
            $fileContents = file_get_contents($targetDir . '/' . $newPluginFileName);
            $replacedContents = str_replace('Template Plugin Name', $pluginName, $fileContents);
            file_put_contents($targetDir . '/' . $newPluginFileName, $replacedContents);

            $output->writeln('<info>Plugin created successfully.</info>');

            // Define the path for composer.json in the child plugin directory
            $composerJsonPath = $targetDir . '/composer.json';

            // Write the composer.json file
            if (file_put_contents($composerJsonPath, json_encode($this->composerDependencies, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) === false) {
                $io->error('Failed to create composer.json file.');
                return Command::FAILURE;
            } else {
                $io->success('composer.json file created successfully.');
            }

            // Run composer install
            $process = new Process(['composer', 'install'], $targetDir);
            try {
                $process->mustRun();
                $io->success('Dependencies installed successfully.');
            } catch (ProcessFailedException $exception) {
                $io->error('Composer install failed: ' . $exception->getMessage());
                return Command::FAILURE;
            }
        } catch (IOExceptionInterface $exception) {
            $output->writeln('<error>An error occurred while creating the plugin.</error>');
        }

        return Command::SUCCESS;
    }
}


