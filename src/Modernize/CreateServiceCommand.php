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
use Symfony\Component\Console\Input\InputArgument;

class CreateServiceCommand extends Command
{
    /** @var false|string  */
    protected $pluginDirPath;

    public function __construct() {
        $this->pluginDirPath = getcwd();
        parent::__construct();
    }

    /**
     * @var OutputInterface
     */
    protected function configure()
    {
        $this
            ->setName('make:service')
            ->setDescription('Creates a new service class with a corresponding repository class.')
            ->addArgument('service', InputArgument::REQUIRED, 'The name of the service to create');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Creating service...');

        // Retrieve the service name from the command argument
        $serviceNameRaw = $input->getArgument('service');
        $serviceName = preg_replace('/Service$/', '', $serviceNameRaw) . 'Service';

        // Automatically construct the Repository Interface name based on the Service name
        $repositoryInterfaceName = preg_replace('/Service$/', 'RepositoryInterface', $serviceName);

        // Automatically construct the Repository variable name based on the Service name
        $repositoryVariableName = preg_replace('/Repository$/', '', $repositoryInterfaceName);

        // Automatically construct the Repository name
        $repositoryName = preg_replace('/RepositoryInterface$/', 'Repository', $repositoryInterfaceName);

        // Get the plugin directory name
        $pluginDirName = basename(getcwd());

        // Convert hyphenated plugin directory name to CamelCase for namespace
        $namespaceBase = $this->hyphenToCamelCase($pluginDirName);
        $namespace = $namespaceBase . '\\Service';
        $repositoryNamespace = $namespaceBase . '\\Repository';

        /**
         * Create the service class.
         */
        // Check if the service already exists
        if (file_exists($this->pluginDirPath . "/src/Service/{$serviceName}.php")) {
            $output->writeln("Service {$serviceName} already exists.");
            return Command::FAILURE;
        }
        $this->generateService($serviceName, $namespace, $repositoryInterfaceName, $repositoryVariableName, $output);

        $output->writeln("Service {$serviceName} created successfully.");

        /**
         * Create the service interface.
         */
        // Check if the service interface already exists
        if (file_exists($this->pluginDirPath . "/src/Service/{$serviceName}Interface.php")) {
            $output->writeln("Service interface for service {$serviceName}Interface already exists.");
            return Command::FAILURE;
        }
        $this->generateServiceInterface($serviceName, $namespace, $output);

        $output->writeln("Service interface for service {$serviceName} created successfully.");

        /**
         * Create the repository class.
         */
        // Check if the repository already exists
        if (file_exists($this->pluginDirPath . "/src/Repository/{$repositoryName}.php")) {
            $output->writeln("Repository {$repositoryName} already exists.");
            return Command::FAILURE;
        }
        $this->generateRepository($repositoryName, $repositoryNamespace, $output);

        $output->writeln("Repository for service {$repositoryName} created successfully.");

        /**
         * Create the repository interface.
         */
        // Check if the repository interface already exists
        if (file_exists($this->pluginDirPath . "/src/Repository/{$repositoryInterfaceName}.php")) {
            $output->writeln("Repository interface {$repositoryInterfaceName} already exists.");
            return Command::FAILURE;
        }
        $this->generateRepositoryInterface($repositoryInterfaceName, $repositoryNamespace, $output);

        $output->writeln("Repository interface for service {$repositoryInterfaceName} created successfully.");

        return Command::SUCCESS;
    }

    /**
     * @param $serviceName
     * @param $namespace
     * @param $repositoryInterfaceName
     * @param $repositoryVariableName
     * @return void
     */
    protected function generateService($serviceName, $namespace, $repositoryInterfaceName, $repositoryVariableName, $output)
    {
        $serviceTemplateContents = file_get_contents($this->pluginDirPath . '/src/Modernize/templates/Service/Service.php');
        $processedServiceTemplate = str_replace(
            ['{{namespace}}', '{{serviceName}}', '{{repositoryInterfaceName}}', '{{repositoryVariableName}}'],
            [$namespace, $serviceName, $repositoryInterfaceName, $repositoryVariableName],
            $serviceTemplateContents
        );
        // Define the path for the new service file
        $filePath = $this->pluginDirPath . "/src/Service/{$serviceName}.php";
        // Write the replaced content to a new service file
        file_put_contents($filePath, $processedServiceTemplate);

        $output->writeLn("Service {$serviceName} created successfully at {$filePath}.");
    }

    /**
     * @param $serviceName
     * @param $namespace
     * @return void
     */
    protected function generateServiceInterface($serviceName, $namespace, $output)
    {
        $serviceInterfaceTemplateContents = file_get_contents($this->pluginDirPath . '/src/Modernize/templates/Service/ServiceInterface.php');
        $processedServiceInterfaceTemplate = str_replace(
            ['{{namespace}}', '{{serviceName}}'],
            [$namespace, $serviceName],
            $serviceInterfaceTemplateContents
        );
        // Define the path for the new service interface file
        $filePath = $this->pluginDirPath . "/src/Service/{$serviceName}Interface.php";
        // Write the replaced content to a new service interface file
        file_put_contents($filePath, $processedServiceInterfaceTemplate);

        $output->writeLn("Service interface {$serviceName}Interface created successfully at {$filePath}.");
    }

    /**
     * @param $repositoryInterfaceName
     * @param $repositoryNamespace
     * @return void
     */
    protected function generateRepository($repositoryInterfaceName, $repositoryNamespace, $output)
    {
        $repositoryTemplateContents = file_get_contents($this->pluginDirPath . '/src/Modernize/templates/Repository/Repository.php');
        $processedRepositoryTemplate = str_replace(
            ['{{namespace}}', '{{repositoryClassName}}', '{{repositoryInterfaceName}'],
            [$repositoryNamespace, $repositoryInterfaceName, $repositoryInterfaceName],
            $repositoryTemplateContents
        );
        // Define the path for the new repository file
        $filePath = $this->pluginDirPath . "/src/Repository/{$repositoryInterfaceName}.php";
        // Write the replaced content to a new repository file
        file_put_contents($filePath, $processedRepositoryTemplate);

        $output->writeLn("Repository {$repositoryInterfaceName} created successfully at {$filePath}.");
    }

    /**
     * @param $repositoryInterfaceName
     * @param $repositoryNamespace
     * @return void
     */
    protected function generateRepositoryInterface($repositoryInterfaceName, $repositoryNamespace, $output)
    {
        $repositoryInterfaceTemplateContents = file_get_contents($this->pluginDirPath . '/src/Modernize/templates/Repository/RepositoryInterface.php');
        $processedRepositoryInterfaceTemplate = str_replace(
            ['{{namespace}}', '{{repositoryInterfaceName}}'],
            [$repositoryNamespace, $repositoryInterfaceName],
            $repositoryInterfaceTemplateContents
        );
        // Define the path for the new repository interface file
        $filePath = $this->pluginDirPath . "/src/Repository/{$repositoryInterfaceName}.php";
        // Write the replaced content to a new repository interface file
        file_put_contents($filePath, $processedRepositoryInterfaceTemplate);

        $output->writeLn("Repository interface {$repositoryInterfaceName} created successfully at {$filePath}.");
    }

    /**
     * Converts a hyphenated string to CamelCase.
     *
     * @param string $string The hyphenated string.
     * @return string The CamelCase string.
     */
    private function hyphenToCamelCase(string $string): string
    {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        return $str;
    }

}



