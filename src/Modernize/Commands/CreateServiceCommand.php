<?php

/**
 * Project: WPPluginModernizer
 * File: CreateServiceCommand.php
 * Author: Kaiser Keenmon
 * Date: 3/5/24
 */

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WPPluginModernizer\Modernize\Traits\Commands\PluginDirectory;
use WPPluginModernizer\Modernize\Utilities\Strings;

class CreateServiceCommand extends Command
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
            ->setName('make:service')
            ->setDescription('Creates a new service class with a corresponding repository class.')
            ->setHelp('This command allows you to create a new service class with a corresponding repository class.')
            ->addArgument('service', InputArgument::REQUIRED, 'The name of the service to create');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Command title
        $io->title('Modernizing a new service class with a corresponding repository class');

        // Retrieve the service name from the command argument
        $serviceNameRaw = $input->getArgument('service');
        $serviceName = preg_replace('/Service$/', '', $serviceNameRaw) . 'Service';

        // Automatically construct the Repository Interface name based on the Service name
        $repositoryInterfaceName = preg_replace('/Service$/', 'RepositoryInterface', $serviceName);

        // Automatically construct the Repository variable name based on the Service name
        $repositoryVariableName = preg_replace('/Repository$/', '', $repositoryInterfaceName);

        // Automatically construct the Repository name
        $repositoryName = preg_replace('/RepositoryInterface$/', 'Repository', $repositoryInterfaceName);

        // Convert hyphenated plugin directory name to CamelCase for namespace
        $namespaceBase = Strings::hyphenToCamelCase($this->pluginDirName);

        /**
         * Create the service class.
         */
        $io->section('Creating the service class');

        // Check if the service already exists
        if (file_exists($this->pluginDirPath . "/src/Service/{$serviceName}.php")) {
            $io->error("Service {$serviceName} already exists.");
            return Command::FAILURE;
        }
        $this->generateFileFromTemplate('service', $serviceName, $namespaceBase, $io);

        /**
         * Create the service interface.
         */
        $io->section('Creating the service interface');

        // Check if the service interface already exists
        if (file_exists($this->pluginDirPath . "/src/Service/{$serviceName}Interface.php")) {
            $io->error("Service interface for service {$serviceName}Interface already exists.");
            return Command::FAILURE;
        }
        $this->generateFileFromTemplate('serviceInterface', $serviceName . 'Interface', $namespaceBase, $io);

        /**
         * Create the repository class.
         */
        $io->section('Creating the repository class');

        // Check if the repository already exists
        if (file_exists($this->pluginDirPath . "/src/Repository/{$repositoryName}.php")) {
            $io->error("Repository {$repositoryName} already exists.");
            return Command::FAILURE;
        }
        $this->generateFileFromTemplate('repository', $repositoryName, $namespaceBase, $io);

        /**
         * Create the repository interface.
         */
        $io->section('Creating the repository interface');

        // Check if the repository interface already exists
        if (file_exists($this->pluginDirPath . "/src/Repository/{$repositoryInterfaceName}.php")) {
            $io->error("Repository interface {$repositoryInterfaceName} already exists.");
            return Command::FAILURE;
        }
        $this->generateFileFromTemplate('repositoryInterface', $repositoryInterfaceName, $namespaceBase, $io);

        return Command::SUCCESS;
    }

    protected function generateFileFromTemplate($type, $name, $namespace, SymfonyStyle $io)
    {
        switch ($type) {
            case 'service':
                $templatePath = $this->pluginDirPath . '/src/Modernize/templates/Service/Service.php';
                $filePath = $this->pluginDirPath . "/src/Service/{$name}.php";
                $pluginFilePath = $this->pluginDirName . "/src/Service/{$name}.php";
                $replacements = [
                    '{{namespace}}' => $namespace,
                    '{{serviceName}}' => $name,
                    '{{repositoryInterfaceName}}' => $name . 'RepositoryInterface',
                    '{{repositoryVariableName}}' => lcfirst($name) . 'Repository',
                ];
                break;
            case 'serviceInterface':
                $templatePath = $this->pluginDirPath . '/src/Modernize/templates/Service/ServiceInterface.php';
                $filePath = $this->pluginDirPath . "/src/Service/{$name}Interface.php";
                $pluginFilePath = $this->pluginDirName . "/src/Service/{$name}.php";
                $replacements = [
                    '{{namespace}}' => $namespace . '\\Service',
                    '{{serviceName}}' => $name,
                ];
                break;
            case 'repository':
                $templatePath = $this->pluginDirPath . '/src/Modernize/templates/Repository/Repository.php';
                $filePath = $this->pluginDirPath . "/src/Repository/{$name}.php";
                $pluginFilePath = $this->pluginDirName . "/src/Repository/{$name}.php";
                $replacements = [
                    '{{namespace}}' => $namespace . '\\Repository',
                    '{{repositoryClassName}}' => $name,
                    '{{repositoryInterfaceName}}' => $name . 'Interface',
                ];
                break;
            case 'repositoryInterface':
                $templatePath = $this->pluginDirPath . '/src/Modernize/templates/Repository/RepositoryInterface.php';
                $filePath = $this->pluginDirPath . "/src/Repository/{$name}.php";
                $pluginFilePath = $this->pluginDirName . "/src/Repository/{$name}.php";
                $replacements = [
                    '{{namespace}}' => $namespace . '\\Repository',
                    '{{repositoryInterfaceName}}' => $name,
                ];
                break;
            default:
                $io->error("Invalid type: $type");
                return;
        }

        $templateContents = include($templatePath);
        $processedContent = str_replace(array_keys($replacements), array_values($replacements), $templateContents);
        file_put_contents($filePath, $processedContent);
        $io->success("$type $name created successfully at $pluginFilePath.");
    }
}



