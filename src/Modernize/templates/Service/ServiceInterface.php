<?php

/**
 * Project: WPPluginModernizer
 * File: ServiceInterfaceTemplate.php
 * Author: WPPluginModernizer
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

namespace {{namespace}};

interface {{serviceName}}
{
    /**
     * Describe the method and its purpose here.
     *
     * @param type \$parameter Description
     * @return type
     */
    public function exampleMethod(\$parameter);
}
TEMPLATE;

return $template;


