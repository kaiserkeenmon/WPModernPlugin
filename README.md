

<p align="center" style="background-color:black; padding:20px; margin-bottom:0;">
  <img src="https://staging.machinelrn.com/images/machinehead.gif" width="80" alt="Logo for Taiko" />
</p>

<h1 align="center" style="background-color:black; color: white; padding-bottom: 20px; margin-top:0;">
  WPModernPlugin <i>Starter</i>
</h1>

<div align="center">
A streamlined WordPress plugin starter kit designed for efficient development, inspired by the best practices of modern PHP architecture.
</div>

<div align="center">

![WordPress](https://img.shields.io/badge/WordPress-%3E%3D5.8-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.1-777BB4.svg)
![Composer](https://img.shields.io/badge/Composer-Enabled-885630.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

</div>

## WPModernPlugin starter demo

[![Watch the Video](https://raw.githubusercontent.com/kaiserkeenmon/WPModernPlugin/master/thumbnail.jpg?token=GHSAT0AAAAAACKFBWNKQ4ERNH6CPL3YIYVOZPGI7PA)](https://www.youtube.com/watch?v=1KjYSDZezp0 "WPModernPlugin Starter Guide")

The above demo video is a brief introduction to the WPModernPlugin starter kit, showcasing its benefits as well as how to 
use it to build modernized WordPress plugin.

**Key Features Highlighted in the Video**:
- PSR-4 Autoloading and Namespacing
- Dependency Injection
- Lazy DI Auto-instantiation
- Flexible Class Integration with PSR-4
- Dependency Inversion
- Managing External Non-PSR-4 Classes 
- A step-by-step guide to creating a plugin with Giphy API integration!

Watch now and learn how the WPModernPlugin starter can modernize your WordPress plugin development!

## Key Plugin Starter Features

- **Modern PHP Practices:** Employs the latest PHP development practices for improved security, efficiency, and readability.

- **PSR-4 Autoloading:** Streamlines class loading for better organization and scalability, adhering to modern PHP 
- standards.

- **Lazy Dependency Injection:** Enhances performance and flexibility by loading services only as needed, with easy 
- swapping of implementations.

- **Flexible Class Integration:** Accommodates both namespaced and non-namespaced classes for seamless third-party 
- library and external class integration.

- **Dependency Inversion:** Ensures high-level modules rely on abstractions rather than low-level modules, 
- promoting maintainable and decoupled code.

- **External Non-PSR-4 Class Support:** Offers integration for external classes outside PSR-4 standards, enhancing 
- the plugin's versatility.

- **Easy Configuration & Customization:** Simplifies setup with a centralized registration file, making customization 
- straightforward.


## Quick Start

### Installation

1. **Download:** Clone or download this repository into your WordPress `plugins` directory.
2. **Rename:** Find and replace 'WPModernPlugin' with your plugin's name across the entire plugin.
3. **Composer:** Run `composer install` to install autoload classes. No external dependencies are included but can be added as needed.
2. **Activate:** Activate the plugin from the WordPress admin panel.
3. **Create:** Now build something great!

## How to Use

- **Develop Your Plugin:** Utilize the `src/` directory for adding PHP classes, adhering to PSR-4 for an organized and scalable codebase.
- **Register Services:** Leverage `src/registration.php` for registering services and repositories, enabling autoloading and dependency injection for streamlined development.

## Contributing

While WPModernPlugin is currently not open for public contributions, feedback and suggestions are welcome. Please feel free to open an issue for any bugs you find or enhancements you think would make the starter kit more useful. For more direct communication, see the contact information below.

## License

WPModernPlugin is open-source software, available under the [MIT license](LICENSE).

## Author

- **LinkedIn:** [kaiser-keenmon](https://linkedin.com/in/kaiser-keenmon)
- **Email:** [kaiser@kaiserkeenmon.com](mailto:kaiser@kaiserkeenmon.com)

