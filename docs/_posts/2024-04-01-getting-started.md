---
title: Getting Started
author: Kaiser Keenmon
date: 2024-04-01 13:10:00 +0800
categories: []
tags: []
render_with_liquid: false
---

- [Creating a Child Plugin](#creating-a-child-plugin)
- [Services](#services)
    * [1. Generate a Service](#1-generate-a-service)
        + [1.1 Register the Generated Service and Repository](#11-register-the-generated-service-and-repository)
        + [1.2 Using the Service and Repository](#12-using-the-service-and-repository)
- [Gutenberg Blocks](#gutenberg-blocks)
    * [2. Generate a Gutenberg Block](#2-generate-a-gutenberg-block)
        + [2.1 Initialize the Block](#21-initialize-the-block)
        + [2.2 Using the Block](#22-using-the-block)
- [API Endpoints](#api-endpoints)
    * [3. Generate an API Endpoint File](#3-generate-an-api-endpoint-file)
        + [3.1 Register the Endpoint](#31-register-the-endpoint)
        + [3.2 Using the Endpoint](#32-using-the-endpoint)
- [Console Commands](#console-commands)
    * [4. Generate a Console Command](#4-generate-a-console-command)
        + [4.1 Register the Console Command](#41-register-the-console-command)
        + [4.2 Using the Command](#42-using-the-command)
      
Welcome to WPPluginModernizer! This guide outlines the steps to create a child plugin for customizations. You'll learn how to generate services, blocks, API endpoints, and console commands to extend your WordPress development efficiently.

## Creating a Child Plugin

Create a child plugin to house your customizations. This ensures your modifications are preserved during parent plugin updates.

## Services

### 1. Generate a Service

``` bash
php modernize make:service [YourServiceName]
```

Replace `[YourServiceName]` with your service's name.

#### 1.1 Register the Generated Service and Repository

After generating your service, register it within your child plugin's `registration.php` file. This step is crucial for your service and repository to be recognized and usable.

#### 1.2 Using the Service and Repository

Utilize the registered service and repository to build your application's functionality.

> Note: Refer to our detailed [user guide video](https://youtu.be/eTvLHtiRS0M?si=fUJcH44IuZ_N9zTB) for a comprehensive walkthrough on using WPPluginModernizer.

## Gutenberg Blocks

### 2. Generate a Gutenberg Block

```
php modernize make:gutenberg-block
```

#### 2.1 Initialize the Block

After generating your block, follow the theme or plugin documentation to properly initialize it, including enqueuing scripts and styles, and registering the block in WordPress.

#### 2.2 Using the Block

Your newly created block can now be added to posts and pages through the Gutenberg editor. Customize and extend it according to your requirements.

> Note: Refer to our detailed [user guide video](https://youtu.be/eTvLHtiRS0M?si=fUJcH44IuZ_N9zTB) for a comprehensive walkthrough on using WPPluginModernizer.

## API Endpoints

### 3. Generate an API Endpoint File

``` bash
php modernize make:api-routes
```

#### 3.1 Register the Endpoint

Add the new API endpoint to your plugin's `registration.php` file to make it available for use within WordPress.

#### 3.2 Using the Endpoint

The registered API endpoint can be used to facilitate communication between your Gutenberg block and the service, enabling dynamic data fetch and manipulation.

> Note: Refer to our detailed [user guide video](https://youtu.be/eTvLHtiRS0M?si=fUJcH44IuZ_N9zTB) for a comprehensive walkthrough on using WPPluginModernizer.

## Console Commands

### 4. Generate a Console Command

``` bash
php modernize make:command [YourProcessName]
```

Replace `[YourProcessName]` with the name for your command.

#### 4.1 Register the Console Command

Register the new command within the `registration.php` file to make it available for use.

#### 4.2 Using the Command

You can now execute your custom command through WP-CLI to automate tasks, run processes, or manage WordPress programmatically.

> Note: Refer to our detailed [user guide video](https://youtu.be/eTvLHtiRS0M?si=fUJcH44IuZ_N9zTB) for a comprehensive walkthrough on using WPPluginModernizer.
