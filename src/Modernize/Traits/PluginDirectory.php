<?php

/**
 * Project: WPPluginModernizer
 * File: PluginDirectoryTrait.php
 * Author: Kaiser Keenmon
 * Date: 3/7/24
 */

namespace WPPluginModernizer\Modernize\Traits;

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
    }
}
