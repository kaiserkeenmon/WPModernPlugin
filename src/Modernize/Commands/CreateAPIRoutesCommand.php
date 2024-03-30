<?php

/**
 * Project: WPPluginModernizer
 * File: CreateServiceCommand.php
 * Author: WPPluginModernizer
 * Date: 3/5/24
 */

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use WPPluginModernizer\Modernize\Traits\Commands\PluginDirectory;

class CreateAPIRoutesCommand extends Command
{
    use PluginDirectory;

    public function __construct() {
        parent::__construct();
        $this->initializePluginDirectory();
    }

    /**
     * @var OutputInterface
     */
    protected function configure()
    {
        $this
            ->setName('make:api-routes')
            ->setDescription('Creates a new API routes file.')
            ->setHelp('This command allows you to create a api-routes.php file.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filesystem = new Filesystem();

        // Load the template
        $parentDir = dirname(dirname(__DIR__)); // Move up two levels from the child plugin
        $templatePath = $parentDir . '/Modernize/templates/Route/api-routes.php';
        $templateContent = include($templatePath);

        // Replace placeholders in the template
        $replacedContent = str_replace(
            ['{{pluginDirName}}'],
            [$this->pluginDirName],
            $templateContent
        );

        // Define the target path for the api-routes.php file
        $targetFilePath = getcwd() . '/api-routes.php';

        // Ensure the file does not already exist
        if ($filesystem->exists($targetFilePath)) {
            $io->error('The api-routes.php file already exists.');
            return Command::FAILURE;
        }

        // Write the replaced content to the new file
        try {
            $filesystem->dumpFile($targetFilePath, $replacedContent);
            $io->success('api-routes.php file created successfully at ' . $this->pluginDirName . '/api-routes.php');
        } catch (\Exception $e) {
            $io->error('An error occurred while creating the api-routes.php file.');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
