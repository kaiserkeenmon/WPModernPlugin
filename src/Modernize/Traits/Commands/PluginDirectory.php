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

    /** @var string */
    protected $parentPluginDirPath;

    /**
     * @return void
     */
    protected function initializePluginDirectory()
    {
        $this->pluginDirPath = getcwd();
        $this->pluginDirName = basename($this->pluginDirPath);
        $this->parentPluginDirPath = dirname(getcwd()) . '/WPPluginModernizer';
    }

    /**
     * @return void
     */
    protected function ensureCalledFromChildPlugin()
    {
        // Check if the current plugin directory is the same as the parent plugin directory.
        if ($this->pluginDirPath === $this->parentPluginDirPath) {
            throw new \RuntimeException('This command cannot be executed from the WPPluginModernizer parent plugin.');
        }
    }

    /**
     * @return void
     */
    protected function ensureCalledFromParentPlugin()
    {
        // Check if the current plugin directory is not the parent plugin directory.
        if ($this->pluginDirPath !== $this->parentPluginDirPath) {
            throw new \RuntimeException('This command can only be executed from the WPPluginModernizer parent plugin.');
        }
    }

    /**
     * @return string
     */
    protected function camelCasedPluginName(): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $this->pluginDirName)));
    }
}
