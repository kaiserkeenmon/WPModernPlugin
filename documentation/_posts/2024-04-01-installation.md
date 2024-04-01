---
title: Installation
author: Kaiser Keenmon
date: 2024-04-01 14:10:00 +0800
categories: []
tags: []
render_with_liquid: false
---

- [WPPluginModernizer Free Version](#wppluginmodernizer-free-version)
    * [Download the Plugin:](#download-the-plugin)
    * [Upload to WordPress:](#upload-to-wordpress)
    * [Activate the Plugin:](#activate-the-plugin)
    * [Install Dependencies:](#install-dependencies)
    * [Create Child Plugin(s) (Use child plugins to develop your custom functionality):](#create-child-plugins-use-child-plugins-to-develop-your-custom-functionality)
    * [Usage:](#usage)
- [WPPluginModernizer Pro Version (Coming Soon...)](#wppluginmodernizer-pro-version-coming-soon)
    * [Purchase and Download:](#purchase-and-download)
    * [Install via WordPress Dashboard:](#install-via-wordpress-dashboard)
    * [Automatic Updates:](#automatic-updates)
    * [Note:](#note)
  
# WPPluginModernizer Free Version

To install WPPluginModernizer Open Source, follow these steps:

## Download the Plugin:

- Download the free version from [wppluginmodernizer.com](http://wppluginmodernizer.com) or fork it from the [GitHub repository](https://github.com/kaiserkeenmon/WPPluginModernizer).

## Upload to WordPress:

1. Extract the downloaded ZIP file on your computer.
2. Navigate to the `/wp-content/plugins/` directory.
3. Upload the extracted WPPluginModernizer folder to this directory.

## Activate the Plugin:

1. Log in to your WordPress admin dashboard.
2. Go to the “Plugins” section.
3. Find WPPluginModernizer in the list of plugins.
4. Click “Activate” below WPPluginModernizer.

## Install Dependencies:
1. `cd` into the WPPluginModernizer directory.
2. Run `composer install` to install the required dependencies.

## Create Child Plugin(s) (Use child plugins to develop your custom functionality):
1. Run `php modernize make:child-plugin [YourChildPluginName]` to create a child plugin with your desired name. This will create a new directory in the `/wp-content/plugins/` directory.

> Note: You can create multiple child plugins to separate your custom functionality. Customizations made to the child plugins will not be affected by updates to WPPluginModernizer.

## Usage:

Once activated, WPPluginModernizer is ready to use. Customize and modernize your WordPress plugins with WPPluginModernizer’s advanced features inspired by modern PHP frameworks.

---

# WPPluginModernizer Pro Version (Coming Soon...)

For WPPluginModernizer Pro:

## Purchase and Download:

- Purchase the WPPluginModernizer Pro version from [wppluginmodernizer.com](http://wppluginmodernizer.com).
- Download the Pro version ZIP file to your computer.

## Install via WordPress Dashboard:

1. Log in to your WordPress admin dashboard.
2. From the main menu, navigate to the “Plugins” section.
3. Click on “Add New” and then “Upload Plugin.”
4. Choose the downloaded Pro version ZIP file.
5. Click “Install Now” and then “Activate” once installed.
6. From the main menu, navigate to “WPPM -> License”.
7. Enter your license key to enable use.

## Automatic Updates:

Once installed, you will receive automatic updates for WPPluginModernizer Pro via the WordPress dashboard.

## Note:

> - WPPluginModernizer Free Version can be manually installed and does not support automatic updates via the WordPress dashboard.
> - WPPluginModernizer Pro Version offers convenient installation, automatic updates, advanced features, as well as customizable, branded child plugin support, enabling the creation of multiple plugin instances that are all powered by WPPluginModernizer.
