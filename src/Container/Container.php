<?php

/**
 * Project: WPModernPlugin
 * File: Container.php
 * Author: Kaiser Keenmon
 * Date: 2/27/24
 */

namespace WPModernPlugin\Container;

class Container
{
    /** @var array */
    private $registrations;

    /** @var array */
    private $instances = [];

    public function __construct(array $registrations)
    {
        $this->registrations = $registrations;
    }

    /**
     * @param $class
     * @return mixed
     * @throws \Exception
     */
    public function get($class)
    {
        if (!isset($this->instances[$class])) {
            if (in_array($class, $this->registrations)) {
                // Assuming class exists and autoloadable via Composer's autoloader
                $this->instances[$class] = new $class($this);
            } else {
                throw new \Exception("Class {$class} is not registered in the container.");
            }
        }

        return $this->instances[$class];
    }

    /**
     * @param $class
     * @return mixed|object|null
     * @throws \ReflectionException
     */
    public function autoWire($class)
    {
        $reflectionClass = new \ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
        if ($constructor !== null) {
            $parameters = $constructor->getParameters();
            $dependencies = [];
            foreach ($parameters as $parameter) {
                $type = $parameter->getType();
                if (!$type instanceof \ReflectionUnionType && !$type instanceof \ReflectionIntersectionType && $type !== null) {
                    $typeName = $type->getName();
                    if (class_exists($typeName)) {
                        $dependencies[] = $this->get($typeName);
                    } else {
                        // Handle the case where the dependency is not a class or interface.
                        if ($parameter->isDefaultValueAvailable()) {
                            $dependencies[] = $parameter->getDefaultValue();
                        } else {
                            throw new \Exception("Cannot resolve the dependency '$typeName' of class '$class'.");
                        }
                    }
                } else {
                    // For PHP 8, handle union types or intersection types
                    throw new \Exception("Union types and intersection types are not supported in this version of autoWire method.");
                }
            }
            return $reflectionClass->newInstanceArgs($dependencies);
        }
        return new $class();
    }

}
