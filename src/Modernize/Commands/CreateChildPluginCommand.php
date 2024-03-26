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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use WPPluginModernizer\Modernize\Traits\Commands\PluginDirectory;

class CreateChildPluginCommand extends Command
{
    use PluginDirectory;

    public function __construct()
    {
        parent::__construct();
        $this->initializePluginDirectory();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('make:child-plugin')
            ->setDescription('Creates a new plugin from the template.')
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
        $pluginName = $input->getArgument('pluginName');
        $sourceDir = $this->pluginDirPath . '/src/Modernize/templates/ChildPlugin/';
        $targetDir = dirname($this->pluginDirPath) . sanitize_title_with_dashes($pluginName);

        $filesystem = new Filesystem();

        try {
            // Copy the template directory to the new location
            $filesystem->mirror($sourceDir, $targetDir);

            // Rename the main plugin file within the new plugin directory
            $originalPluginFileName = 'child-plugin.php';
            $newPluginFileName = sanitize_title_with_dashes($pluginName) . '.php';
            $filesystem->rename($targetDir . '/' . $originalPluginFileName, $targetDir . '/' . $newPluginFileName);

            // Update the plugin header in the new main file
            $fileContents = file_get_contents($targetDir . '/' . $newPluginFileName);
            $replacedContents = str_replace('Template Plugin Name', $pluginName, $fileContents);
            file_put_contents($targetDir . '/' . $newPluginFileName, $replacedContents);

            // Generate scaffold-config.php
            $configContent = "<?php\n\nreturn [\n    'pluginPath' => __DIR__,\n    // Additional config items can go here\n];\n";
            $configFilePath = $targetDir . '/scaffold-config.php';
            $filesystem->dumpFile($configFilePath, $configContent);

            $output->writeln('<info>Plugin created successfully.</info>');
            $output->writeln('<info>scaffold-config.php generated successfully.</info>');
        } catch (IOExceptionInterface $exception) {
            $output->writeln('<error>An error occurred while creating the plugin.</error>');
        }

        return Command::SUCCESS;
    }
}


