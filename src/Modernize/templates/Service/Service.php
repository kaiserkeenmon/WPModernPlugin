<?php

/**
 * Project: WPPluginModernizer
 * File: ServiceTemplate.php
 * Author: Kaiser Keenmon
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

namespace {{namespace}}\\Service;

use {{namespace}}\\Repository\\{{repositoryInterfaceName}};

class {{serviceName}} implements {{serviceName}}Interface {

    /** @var {{repositoryInterfaceName}} */
    protected \${{repositoryVariableName}};

    public function __construct({{repositoryInterfaceName}} \${{repositoryVariableName}}) {
        \$this->{{repositoryVariableName}} = \${{repositoryVariableName}};
    }

    /**
     * Example method.
     *
     * Modify this stub to fit your service's needs.
     *
     * @param mixed \$parameter Description of the parameter
     * @return mixed
     */
    public function exampleMethod(\$parameter) {
        // Implement method functionality here
        // Example: return \$this->{{repositoryVariableName}}->find(\$parameter);
    }
}
TEMPLATE;

return $template;
