<?php

/**
 * Project: WPPluginModernizer
 * File: CreateConsoleCommand.php
 * Author: WPPluginModernizer
 * Date: 3/22/24
 */

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WPPluginModernizer\Modernize\Traits\Commands\PluginDirectory;

class CreateConsoleCommand extends Command
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
            ->setName('make:command')
            ->setDescription('Generates a custom command class (child only).')
            ->addArgument('commandName', InputArgument::REQUIRED, 'The name of the custom command.');
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
        $commandName = $input->getArgument('commandName');
        $commandClassName = ucfirst($commandName) . 'Command';
        $commandSlug = strtolower($commandName);

        // Load the command template
        $templatePath = $this->parentPluginDirPath . '/src/Modernize/templates/Command/Command.php';
        $template = include($templatePath);
        $nameSpaceName = $this->camelCasedPluginName();

        // Replace placeholders
        $filledTemplate = str_replace(
            ['{{nameSpaceName}}', '{{commandClassName}}', '{{commandName}}', '{{commandDescription}}'],
            [$nameSpaceName, $commandClassName, $commandSlug, 'Your command description here. Customize as needed.'],
            $template
        );

        // Define the file path
        $path = $this->pluginDirPath . "/src/Console/{$commandClassName}.php";
        $relativePath = $this->pluginDirName . "/src/Console/{$commandClassName}.php";

        // Write the command class file
        if (file_put_contents($path, $filledTemplate) !== false) {
            $io->success("Custom command class created at: {$relativePath}");
            $io->note([
                "Customize the command logic and description as needed.",
                "To make your new command available, register it in 'src/Console/registration.php'.",
                "Ensure your new command is properly loaded and available by checking with 'php modernize list-commands'."
            ]);
        } else {
            $io->error("Failed to create custom command class at: {$relativePath}");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
