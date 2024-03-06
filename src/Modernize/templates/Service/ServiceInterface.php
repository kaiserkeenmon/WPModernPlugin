<?php

/**
 * Project: WPModernPlugin
 * File: ServiceInterfaceTemplate.php
 * Author: Kaiser Keenmon
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

namespace {{namespace}};

/**
 * Interface {{serviceName}}Interface
 *
 * Describe the purpose of the interface here.
 */
interface {{serviceName}}Interface
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


