

<p align="center" style="background-color:black; padding:20px; margin-bottom:0;">
  <img src="https://raw.githubusercontent.com/kaiserkeenmon/WPPluginModernizer/master/wppm-logo.png" width="80" alt="Logo for Taiko" />
</p>

<h1 align="center" style="background-color:black; color: white; padding-bottom: 20px; margin-top:0;">
  WPPluginModernizer
</h1>

<div align="center">
A WordPress plugin designed to modernize plugin development, inspired by the best practices of modern PHP 
architecture seen in frameworks like Magento, Laravel, and Symfony. This plugin aims to revolutionize your development 
process, incorporating features such as PSR-4 autoloading, dependency injection, code scaffolding, and more.
</div>

<div align="center" style="padding: 20px 0;">


![WordPress](https://img.shields.io/badge/WordPress-%3E%3D5.8-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.1-777BB4.svg)
![Composer](https://img.shields.io/badge/Composer-Enabled-885630.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
</div>

## Unleashing WPPluginModernizer: Revolutionize WordPress Plugin Development

To watch the intro video below without navigating away from GitHub, right-click on the link and select "Open link in new tab". 
[![Watch the Video](https://raw.githubusercontent.com/kaiserkeenmon/WPPluginModernizer/master/thumb.png)](https://youtu.be/gdDSBzfBm50?si=ak1Uheubbe4oMeQj "WPPluginModernizer Intro")

The above video is a brief intro to WPPluginModernizer, highlighting its features and how it can revolutionize your WordPress plugin development.

## Key Plugin Features

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
- **Configurable Console Commands**: Offers a flexible console command infrastructure for extending the plugin with custom commands.


## Quick Start

Follow these steps to get started with WPPluginModernizer:

### Installation

1. **Download:** Clone or download this repository into your WordPress `plugins` directory.
2. **Composer Installation:** Run `composer install` to install PHP class autoloading and dependencies.
3. **Rebrand Plugin (Optional):** Run `php modernize rebrand YourPluginName` to rebrand the plugin with your desired name. This allows you to not only rebrand the plugin, but also enables you to install multiple instances of the plugin for developing separate, more modular features.
4. **Activate:** Activate the plugin from the WordPress admin panel.
5. **Create:** Start building something great! Utilize the WPPluginModernizer's features, including PSR-4 autoloading, dependency injection, and console commands for scaffolding services, REST API routes, and Gutenberg blocks.

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

> ### Note: See the user guide video [here](https://youtu.be/74py3FYiX8U) for a detailed walkthrough on using WPPluginModernizer.

## Contributing

While WPPluginModernizer is currently not open for public contributions, feedback and suggestions are welcome. Please feel 
free to open an issue for any bugs you find or enhancements you think would make the plugin more useful. 
For more direct communication, see the contact information below.

I'd love to hear what you build with WPPluginModernizer, so please feel free to share your projects with me!

## License

WPPluginModernizer is open-source software, available under the [MIT license](LICENSE).

## Author

- **LinkedIn:** [kaiser-keenmon](https://linkedin.com/in/kaiser-keenmon)
- **Email:** [kaiser@kaiserkeenmon.com](mailto:kaiser@kaiserkeenmon.com)

