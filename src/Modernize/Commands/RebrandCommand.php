<?php

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WPPluginModernizer\Modernize\Traits\Commands\PluginDirectory;

class RebrandCommand extends Command
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
            ->setName('rebrand')
            ->setDescription('Rebrands the plugin with a new directory and plugin name.')
            ->addArgument('pluginName', InputArgument::REQUIRED, 'The new directory name for the plugin.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $pluginName = $input->getArgument('pluginName');

        $currentDirectory = getcwd();
        $mainPluginFile = $currentDirectory . '/wp-plugin-modernizer.php';

        // Prompt for manual deactivation
        $io->note("Please ensure the plugin is deactivated from the WordPress admin dashboard before continuing.");

        // Wait for user confirmation
        if (!$io->confirm('Is the plugin deactivated?')) {
            $io->error('Plugin rebranding aborted. Please deactivate the plugin first.');
            return Command::FAILURE;
        }

        // Update the Plugin Name in the main plugin file.
        $contents = file_get_contents($mainPluginFile);
        $updatedContents = preg_replace('/(Plugin Name:\s*).*/', "$1$pluginName", $contents);
        file_put_contents($mainPluginFile, $updatedContents);

        // Rename the plugin directory.
        $parentDir = dirname($currentDirectory);
        $newDirectoryPath = $parentDir . DIRECTORY_SEPARATOR . $pluginName;
        rename($currentDirectory, $newDirectoryPath);

        $io->success("Plugin rebranded to '$pluginName'. Please reactivate the plugin under its new name from the WordPress admin dashboard.");

        return Command::SUCCESS;
    }
}
