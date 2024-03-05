<?php

/**
 * Project: WPModernPlugin
 * File: CreateServiceCommand.php
 * Author: kaiser
 * Date: 3/5/24
 */

namespace WPModernPlugin\Modernize;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Question\Question;

class CreateServiceCommand extends Command
{
    /** @var string  */
    protected static $defaultName = 'make:service';

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setDescription('Creates a new service class with a corresponding repository.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the service');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $serviceName = $input->getArgument('serviceName');
        $helper = $this->getHelper('question');

        $namespaceQuestion = new Question('Please enter the namespace of the service: ', 'App\\Service');
        $namespace = $helper->ask($input, $output, $namespaceQuestion);

        $repositoryInterfaceNameQuestion = new Question('Please enter the repository interface name (e.g., "GiphyRepositoryInterface"): ');
        $repositoryInterfaceName = $helper->ask($input, $output, $repositoryInterfaceNameQuestion);

        $repositoryVariableNameQuestion = new Question('Please enter the repository variable name (e.g., "giphyRepository"): ');
        $repositoryVariableName = $helper->ask($input, $output, $repositoryVariableNameQuestion);

        $methodNameQuestion = new Question('Please enter the method name (e.g., "searchGifs"): ');
        $methodName = $helper->ask($input, $output, $methodNameQuestion);

        $parameterNameQuestion = new Question('Please enter the parameter name (e.g., "searchTerm"): ');
        $parameterName = $helper->ask($input, $output, $parameterNameQuestion);

        $repositoryMethodNameQuestion = new Question('Please enter the repository method name (e.g., "searchGifs"): ');
        $repositoryMethodName = $helper->ask($input, $output, $repositoryMethodNameQuestion);

        $templateContents = file_get_contents(WP_PLUGIN_DIR . '/src/Modernize/templates/ServiceTemplate.php');

        // Replace placeholders in the template
        $processedTemplate = str_replace(
            ['{{namespace}}', '{{serviceName}}', '{{repositoryInterfaceName}}', '{{repositoryVariableName}}', '{{methodName}}', '{{parameterName}}', '{{repositoryMethodName}}'],
            [$namespace, $serviceName, $repositoryInterfaceName, $repositoryVariableName, $methodName, $parameterName, $repositoryMethodName],
            $templateContents
        );

        // Define the path for the new service file
        $filePath = WP_PLUGIN_DIR . "/src/Service/{$serviceName}.php";

        // Write the replaced content to a new service file
        file_put_contents($filePath, $processedTemplate);

        $output->writeln("Service {$serviceName} created successfully at {$filePath}.");

        return Command::SUCCESS;
    }
}



