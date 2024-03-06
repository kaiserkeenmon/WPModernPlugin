<?php

/**
 * Project: WPModernPlugin
 * File: RepositoryTemplate.php
 * Author: Kaiser Keenmon
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

namespace {{ namespace }}\Repository;

class {{ repositoryClassName }} implements {{ repositoryInterfaceName }}
{
    public function exampleMethod(array \$parameter): array
    {
        // Implement logic here
    }
}
TEMPLATE;
