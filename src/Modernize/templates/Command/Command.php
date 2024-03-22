<?php

/**
 * Project: WPPluginModernizer
 * File: CommandTemplate.php
 * Author: WPPluginModernizer
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

namespace WPPluginModernizer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class {{commandClassName}} extends Command
{
    protected function configure()
    {
        \$this
            ->setName('{{commandName}}')
            ->setDescription('{{commandDescription}}');
    }

    protected function execute(InputInterface \$input, OutputInterface \$output): int
    {
        // Command logic here

        return Command::SUCCESS;
    }
}
TEMPLATE;

return $template;
