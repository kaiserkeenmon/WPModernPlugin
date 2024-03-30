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
}
