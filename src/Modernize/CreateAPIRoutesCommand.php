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
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class CreateAPIRoutesCommand extends Command
{
    protected static $defaultName = 'make:api-routes';

    protected function configure()
    {
        $this
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

        $sourceFilePath = __DIR__ . '/templates/Routes/api-routes.php'; // Adjust the path to your template file
        $targetFilePath = getcwd() . '/api-routes.php'; // Adjust the target path as necessary

        try {
            // Check if the target file already exists to avoid overwriting
            if ($filesystem->exists($targetFilePath)) {
                $io->error('The api-routes.php file already exists.');
                return Command::FAILURE;
            }

            $filesystem->copy($sourceFilePath, $targetFilePath);
            $io->success('api-routes.php file created successfully.');

        } catch (IOExceptionInterface $exception) {
            $io->error('An error occurred while creating the api-routes.php file.');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
