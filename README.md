

<p align="center" style="background-color:black; padding:20px; margin-bottom:0;">
  <img src="https://raw.githubusercontent.com/kaiserkeenmon/WPPluginModernizer/master/wppm-logo.png" width="80" alt="Logo for Taiko" />
</p>

<h1 align="center" style="background-color:black; color: white; padding-bottom: 20px; margin-top:0;">
  WPPluginModernizer
</h1>

<div align="center" style="padding-bottom:20px">
<a href="https://wppluginmodernizer.com">wppluginmodernizer.com</a>
</div>

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
[![Watch the Video](https://raw.githubusercontent.com/kaiserkeenmon/WPPluginModernizer/master/thumb.png)](https://youtu.be/vkUaMRt0jx4?si=WC3izCFvam-Np7Aa "WPPluginModernizer Intro")

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
    ```php
    php modernize make:command DoSomething
    ```

## How to Use WPPluginModernizer

View the docs for information on installing, updating and using WPPluginModernizer. The documentation provides a comprehensive guide to help you get started with the plugin and make the most of its features.

- [WPPluginModernizer Docs](https://kaiserkeenmon.github.io/WPPluginModernizer/)

> ### Note: See the user guide video [here](https://youtu.be/eTvLHtiRS0M?si=fUJcH44IuZ_N9zTB) for a detailed walkthrough on using WPPluginModernizer.

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

