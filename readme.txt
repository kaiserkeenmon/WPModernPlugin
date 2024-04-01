=== WPPluginModernizer ===
Contributors: (your WordPress.org username)
Tags: modern PHP, PSR-4, dependency injection, code scaffolding
Requires at least: 5.8
Tested up to: 6.4
Stable tag: 1.0.1
Requires PHP: 8.1
License: MIT
License URI: https://opensource.org/licenses/MIT

A WordPress plugin designed to modernize plugin development, inspired by the best practices of modern PHP architecture seen in frameworks like Magento, Laravel, and Symfony.

== Description ==
WPPluginModernizer revolutionizes WordPress plugin development by incorporating features such as PSR-4 autoloading, dependency injection, code scaffolding, and more. This plugin aims to improve efficiency, maintainability, and performance by employing the latest PHP development practices.

Key Features Include:
- Modern PHP Practices for enhanced efficiency and maintainability.
- PSR-4 Autoloading for better organization and scalability.
- Lazy Dependency Injection for performance and flexibility.
- Console Command CLI for scaffolding services, REST API routes, and Gutenberg blocks.

== Installation ==
1. Download or clone this repository into your WordPress `plugins` directory.
2. Run `composer install` to install PHP class autoloading and dependencies.
3. Activate the plugin from the WordPress admin panel.
4. Run `php modernize make:child-plugin [YourAwesomePluginName]` to generate a customizable child plugin.
5. Customize the generated child plugin to suit your needs.
7. For more detailed installation instructions, visit our documentation: https://kaiserkeenmon.github.io/WPPluginModernizer

== Frequently Asked Questions ==
= Can I use this plugin without composer? =
No, composer is required for autoloading PHP classes and managing dependencies.

= How do I create a new service or Gutenberg block? =
Use the provided console commands, e.g., `php modernize make:service MyNewService`, for scaffolding.

== Screenshots ==
1. A customizable child plugin generated with WPPluginModernizer CLI tool.
2. A console command generated with WPPluginModernizer's scaffolding.

== Changelog ==

= 1.0.2 =
- Added customizable child plugin generation.

= 1.0.1 =
- Added support for creating custom console commands.

== Upgrade Notice ==

= 1.0.2 =
- Added customizable child plugin generation.

= 1.0.1 =
- Added support for creating custom console commands.

= 1.0.0 =
- Initial Release. Core plugin functionality.

== Notice ==
- While WPPluginModernizer is not open for public contributions, feedback and suggestions are welcome. Please feel free to share your projects and how you're using WPPluginModernizer to enhance your WordPress development.

== License ==
This plugin is open-source software licensed under the MIT license.
