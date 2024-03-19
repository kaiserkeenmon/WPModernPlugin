

<p align="center" style="background-color:black; padding:20px; margin-bottom:0;">
  <img src="https://staging.machinelrn.com/images/machinehead.gif" width="80" alt="Logo for Taiko" />
</p>

<h1 align="center" style="background-color:black; color: white; padding-bottom: 20px; margin-top:0;">
  WPPluginModernizer <i>Starter</i>
</h1>

<div align="center">
A WordPress plugin designed to modernize plugin development, inspired by the best practices of modern PHP 
architecture seen in frameworks like Magento, Laravel, and Symfony. This starter aims to revolutionize your development 
process, incorporating features such as PSR-4 autoloading, dependency injection, code scaffolding, and more.
</div>

<div align="center" style="padding: 20px 0;">


![WordPress](https://img.shields.io/badge/WordPress-%3E%3D5.8-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.1-777BB4.svg)
![Composer](https://img.shields.io/badge/Composer-Enabled-885630.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
</div>

## WPPluginModernizer starter demo

To watch the demo without navigating away from GitHub, right-click on the link and select "Open link in new tab". 
[![Watch the Video](https://raw.githubusercontent.com/kaiserkeenmon/WPPluginModernizer/2a0d6e482ac5515a4469debbb35f2b41f3e5498d/thumbnail.jpg)](https://youtu.be/SZrRi3xd4Qo "WPPluginModernizer Starter Guide")


The above demo is a brief intro to the WPPluginModernizer starter, highlighting its features and demoing how to 
use it to build a modernized WordPress plugin.

## Key Plugin Starter Features

- **Modern PHP Practices**: Employs the latest PHP development practices for *improved efficiency*, *maintainability*, and *performance*.
- **PSR-4 Autoloading**: Streamlines class loading for better organization and scalability, adhering to [modern PHP standards](https://www.php-fig.org/psr/psr-4/).
- **Lazy Dependency Injection**: Enhances performance and flexibility by loading services only as needed, with easy swapping of implementations. More on [dependency injection](https://en.wikipedia.org/wiki/Dependency_injection).
- **Flexible Class Integration**: Accommodates both [namespaced](https://www.php.net/manual/en/language.namespaces.rationale.php) and non-namespaced classes for seamless third-party library and external class integration.
- **Dependency Inversion**: Ensures high-level modules rely on abstractions rather than low-level modules, promoting *maintainable* and *decoupled code*. Learn about the [Dependency Inversion Principle](https://en.wikipedia.org/wiki/Dependency_inversion_principle).
- **Easy Configuration & Customization**: Simplifies setup with a centralized registration file, making customization straightforward.
- **Console Command CLI**: Introduces a [Symfony Console](https://symfony.com/doc/current/components/console.html)-based toolkit for scaffolding services, REST API routes, and Gutenberg blocks, streamlining development.
    
- **Service Scaffolding**: Quickly generate boilerplate code for new services and repositories, saving time and enforcing best practices.  
    ```php
    php modernize make:service MyNewService
    ```
- **Gutenberg Block Scaffolding**: Quickly generate boilerplate code for new Gutenberg blocks, accelerating development.
    ```php
    php modernize make:gutenberg-block
    ```
- **REST API Route Generation**: Generate an API route file, saving time and enforcing best practices.
    ```php
    php modernize make:api-routes
    ```
- **Configurable Console Commands**: Offers a flexible console command infrastructure for extending the starter kit with custom commands.


## Quick Start

Follow these steps to get started with WPPluginModernizer:

### Installation

1. **Download:** Clone or download this repository into your WordPress `plugins` directory.
2. **Rename (Optional):** If you prefer, find and replace 'WPPluginModernizer' with your plugin's unique name across the entire plugin.
3. **Update Composer Autoloading (If Renamed):** If you've renamed the plugin, ensure to update the `composer.json` file to reflect the new directory-to-namespace mapping. Modify the `autoload` section to match your new plugin's namespace. For example:

    ```json
    "autoload": {
        "psr-4": {
            "YourPluginNamespace\\": "src/"
        }
    }
    ```
   After updating, run `composer dump-autoload` to refresh the autoload files with your changes.

4. **Composer Installation:** Run `composer install` to install PHP class autoloading and dependencies.
5. **Activate:** Activate the plugin from the WordPress admin panel.

6. **Create:** Start building something great! Utilize the WPPluginModernizer's features, including PSR-4 autoloading, dependency injection, and console commands for scaffolding services, REST API routes, and Gutenberg blocks.

## How to Use

### Utilize the Modernize CLI for Scaffolding
- **Jumpstart Development:** Leverage the provided console commands to scaffold services, REST API routes, and Gutenberg blocks quickly. This helps maintain consistency and best practices across your plugin development.

- **Generate a Service**:
```bash
php modernize make:service YourServiceName
```

- **Create a REST API Route**:
```bash
php modernize make:api-routes
```

- **Scaffold Gutenberg Blocks**:
```bash
php modernize make:block
```

### Develop Your Plugin
- **Organize Your Codebase:** Place PHP classes within the `src/` directory, ensuring they adhere to the PSR-4 naming convention for an organized and scalable codebase. For example:

```php
namespace YourPluginNamespace\SubNamespace;

class YourClassName {
    // Your class implementation
}
```

### Register Services and Repositories
- **Simplify Service Management:** Use the src/registration.php file to register your services and repositories with the DI container. This central registration facilitates autoloading and dependency injection, streamlining your development process. Example:

```php
return [
    YourPluginNamespace\Service\YourServiceInterface::class => [
        'class' => YourPluginNamespace\Service\Implementation\YourService::class,
        'singleton' => true, // Optional: Define as a singleton service
    ],
    YourPluginNamespace\Repository\YourRepositoryInterface::class => [
        'class' => YourPluginNamespace\Repository\Implementation\YourRepository::class,
        'params' => ['dependency1', 'dependency2'], // Optional: Constructor parameters
    ],
    // Add more class DI container registrations as needed
];
```

> ### Note: See the video above for a detailed guide on using the WPPluginModernizer starter.

## Contributing

While WPPluginModernizer is currently not open for public contributions, feedback and suggestions are welcome. Please feel 
free to open an issue for any bugs you find or enhancements you think would make the starter more useful. 
For more direct communication, see the contact information below.

I'd love to hear what you build with WPPluginModernizer, so please feel free to share your projects with me!

## License

WPPluginModernizer is open-source software, available under the [MIT license](LICENSE).

## Author

- **LinkedIn:** [kaiser-keenmon](https://linkedin.com/in/kaiser-keenmon)
- **Email:** [kaiser@kaiserkeenmon.com](mailto:kaiser@kaiserkeenmon.com)

