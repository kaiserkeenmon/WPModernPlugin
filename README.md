# WPModernPlugin

A streamlined starter kit for WordPress plugin development, focusing on simplicity, best practices, and modern standards.

## Introduction

WPModernPlugin offers a foundational structure to kickstart your WordPress plugin development. 
Designed with simplicity and modern development practices in mind, it provides an essential set of features such as 
PSR-4 autoloading and Dependency Injection (DI) with lazy instantiation, as well as integration capabilities for non-PSR-4 classes.

## Features

- **PSR-4 Autoloading:** Organize your plugin classes with modern namespacing, making your code cleaner and more maintainable.
- **Lazy Dependency Injection:** Only load what you need, when you need it, enhancing your plugin's performance.
- **Non-PSR-4 Class Integration:** Seamlessly integrate third-party or legacy classes without namespacing into your modern workflow.

## Getting Started

1. Clone or download WPModernPlugin into your WordPress plugins directory.
2. If necessary, run `composer install` within your plugin directory to set up autoloading. Note: Composer can also be used to add any additional PHP packages required for your project.
3. Activate the plugin from the WordPress admin interface.
4. Build something great!

## Usage

### Defining Services and Repositories

Create your service and repository classes within the `src/Service` and `src/Repository` directories, respectively. Register these classes in `src/registration.php` for autoloading and dependency injection.

### Integrating Non-PSR-4 Classes

For external classes without namespacing, specify the class name and its file path in `src/registration.php`. WPModernPlugin will handle the rest.

## Contributing

Contributions are welcome! Please feel free to submit pull requests or create issues for bugs and feature requests.

## License

WPModernPlugin is open-sourced software licensed under the [MIT license](LICENSE).
