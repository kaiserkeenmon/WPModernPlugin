<?php

/**
 * Project: WPModernPlugin
 * File: CreateServiceCommand.php
 * Author: Kaiser Keenmon
 * Date: 3/5/24
 */

namespace WPModernPlugin\Modernize;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use WPModernPlugin\Modernize\Traits\PluginDirectory;

class CreateAPIRoutesCommand extends Command
{
    use PluginDirectory;

    /** @var false|string  */
    protected $pluginDirPath;

    /** @var string  */
    protected $pluginDirName;

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

        // Determine the plugin directory name dynamically
        $pluginDirName = basename(getcwd());

        // Load the template
        $templatePath = __DIR__ . '/templates/Routes/api-routes.php';
        $templateContent = include($templatePath);

        // Replace placeholders in the template
        $replacedContent = str_replace(
            ['{{pluginDirName}}'],
            [$pluginDirName],
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
            $io->success('api-routes.php file created successfully at ' . $targetFilePath);
        } catch (\Exception $e) {
            $io->error('An error occurred while creating the api-routes.php file.');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
