<?php

/**
 * Project: WPModernPlugin
 * File: PluginDirectoryTrait.php
 * Author: Kaiser Keenmon
 * Date: 3/7/24
 */

namespace WPModernPlugin\Modernize\Traits;

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
