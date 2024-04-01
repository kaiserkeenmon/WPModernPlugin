<?php

/**
 * Project: WPPluginModernizer
 * File: CustomApplication.php
 * Author: Kaiser Keenmon
 * Date: 3/22/24
 */

namespace WPPluginModernizer\Modernize\Commands;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomApplication extends BaseApplication
{
    use \Activation;

    /**
     * @param Command $command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Throwable
     */
    protected function doRunCommand(Command $command, InputInterface $input, OutputInterface $output): int
    {
        // Ensure the plugin is activated before proceeding
        $this->ensurePluginActivated();

        // Output ASCII art text before running any command
        $output->writeln([
            '<fg=magenta>  _      _____  ___  __          _      __  ___        __             _            </>',
            '<fg=magenta> | | /| / / _ \/ _ \/ /_ _____ _(_)__  /  |/  /__  ___/ /__ _______  (_)__ ___ ____</>',
            '<fg=magenta> | |/ |/ / ___/ ___/ / // / _ `/ / _ \/ /|_/ / _ \/ _  / -_) __/ _ \/ /_ // -_) __/</>',
            '<fg=magenta> |__/|__/_/  /_/  /_/\_,_/\_, /_/_//_/_/  /_/\___/\_,_/\__/_/ /_//_/_//__/\__/_/   </>',
            '<fg=magenta>                         /___/                                                      </>',
            '',
        ]);

        // Call parent method to handle actual command execution
        return parent::doRunCommand($command, $input, $output);
    }
}
