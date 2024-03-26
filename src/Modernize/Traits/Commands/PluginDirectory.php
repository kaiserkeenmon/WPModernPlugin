<?php

/**
 * Project: WPPluginModernizer
 * File: PluginDirectoryTrait.php
 * Author: WPPluginModernizer
 * Date: 3/7/24
 */

namespace WPPluginModernizer\Modernize\Traits\Commands;

trait PluginDirectory
{
    /** @var false|string */
    protected $pluginDirPath;

    /** @var string */
    protected $pluginDirName;

    /**
     * @return void
     */
    protected function initializePluginDirectory()
    {
        $this->pluginDirPath = getcwd();
        $this->pluginDirName = basename($this->pluginDirPath);

        // Check for scaffold-config.php in the current directory
        $configPath = $this->pluginDirPath . '/scaffold-config.php';
        if (file_exists($configPath)) {
            $config = include $configPath;
            if (isset($config['pluginPath'])) {
                $this->pluginDirPath = $config['pluginPath'];
                $this->pluginDirName = basename($this->pluginDirPath);
            }
        }
    }
}
