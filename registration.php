<?php

/**
 * Project: WPModernPlugin
 * File: Container.php
 * Author: Kaiser Keenmon
 * Date: 2/27/24
 */

return [
    // Example of a simple class registration without parameters
    ClassA::class => [
        'class' => MyClass::class,
    ],

    // Example with constructor parameters
    ClassBInterface::class => [
        'class' => ClassBRepository::class,
        'params' => ['apiKey' => 'api_key_here'],
    ],

    // Example marking a service as a singleton
    ClassC::class => [
        'class' => ClassCService::class,
        'singleton' => true,
    ],
];
