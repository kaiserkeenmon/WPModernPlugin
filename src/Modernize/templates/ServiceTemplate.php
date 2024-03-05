<?php

/**
 * Project: WPModernPlugin
 * File: ServiceTemplate.php
 * Author: kaiser
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

/**
 * Project: WPModernPlugin
 * File: ServiceTemplate.php
 * Author: kaiser
 * Date: 3/5/24
 */

namespace {{namespace}}\\Service;

use {{namespace}}\\Repository\\{{repositoryInterfaceName}};

class {{serviceName}} implements {{serviceName}}Interface {

    /** @var {{repositoryInterfaceName}}  */
    protected \${{repositoryVariableName}};

    public function __construct({{repositoryInterfaceName}} \${{repositoryVariableName}}) {
        \$this->{{repositoryVariableName}} = \${{repositoryVariableName}};
    }

    /**
     * Method description
     *
     * @param string \$parameterName Description of the parameter
     * @return array
     */
    public function {{methodName}}(string \$parameterName): array {
        // Implement method functionality here
        \$results = \$this->{{repositoryVariableName}}->{{repositoryMethodName}}(\$parameterName);
        return \$results;
    }
}
TEMPLATE;
