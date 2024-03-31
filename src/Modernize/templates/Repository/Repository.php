<?php

/**
 * Project: WPPluginModernizer
 * File: RepositoryTemplate.php
 * Author: WPPluginModernizer
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

namespace {{namespace}};

class {{repositoryClassName}} implements {{repositoryInterfaceName}}
{
    /**
    * @param array $\$parameter
    * @return array
     */
    public function exampleMethod(array \$parameter): array
    {
        // Implement logic here
    }
}
TEMPLATE;

return $template;
