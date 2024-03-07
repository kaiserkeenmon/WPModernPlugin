<?php

/**
 * Project: WPModernPlugin
 * File: RepositoryTemplate.php
 * Author: Kaiser Keenmon
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

namespace {{namespace}};

/**
 * Interface {{repositoryInterfaceName}}
 *
 * Describe the purpose of the interface here.
 */
interface {{repositoryInterfaceName}}
{
    /**
     * Describe the method and its purpose here.
     *
     * @param type \$parameter Description
     * @return type
     */
    public function exampleMethod(array \$parameter): array;
}
TEMPLATE;

return $template;

