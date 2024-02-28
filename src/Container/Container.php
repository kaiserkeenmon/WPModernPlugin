<?php

/**
 * Project: WPModernPlugin
 * File: Container.php
 * Author: Kaiser Keenmon
 * Date: 2/28/24
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
     * Get or make an instance of the class.
     * @param string $abstract
     * @return mixed The instance of the class.
     * @throws \Exception
     */
    public function get($abstract)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (!isset($this->registrations[$abstract])) {
            throw new \Exception("No registration for {$abstract}.");
        }

        return $this->make($abstract);
    }

    /**
     * Build an instance of the class with optional parameters and handle singletons.
     * @param string $abstract
     * @return mixed The instance of the class.
     * @throws \Exception
     */
    protected function make($abstract)
    {
        $registration = $this->registrations[$abstract];

        if (isset($registration['singleton']) && $registration['singleton']) {
            return $this->getSingletonInstance($abstract, $registration);
        }

        return $this->buildInstance($registration);
    }

    /**
     * Build an instance of the class using the constructor parameters.
     * @param array $registration
     * @return object The instantiated class.
     * @throws \ReflectionException
     */
    protected function buildInstance($registration)
    {
        $reflector = new \ReflectionClass($registration['class']);
        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class {$registration['class']} is not instantiable.");
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $registration['class']();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters, $registration);

        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * Resolve the dependencies for the constructor parameters.
     * @param \ReflectionParameter[] $parameters
     * @param array $registration
     * @return array
     * @throws \Exception
     */
    protected function resolveDependencies($parameters, $registration)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            $typeName = $type && !$type->isBuiltin() ? $type->getName() : null;

            if ($typeName && isset($this->registrations[$typeName])) {
                $dependencies[] = $this->get($typeName);
            } elseif (isset($registration['params'][$parameter->getName()])) {
                $dependencies[] = $registration['params'][$parameter->getName()];
            } elseif ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                throw new \Exception("Cannot resolve the dependency '{$parameter->getName()}' for class '{$registration['class']}'.");
            }
        }

        return $dependencies;
    }

    /**
     * Get or create a singleton instance of the class.
     * @param string $abstract
     * @param array $registration
     * @return mixed The singleton instance of the class.
     */
    protected function getSingletonInstance($abstract, $registration)
    {
        if (!isset($this->instances[$abstract])) {
            $this->instances[$abstract] = $this->buildInstance($registration);
        }

        return $this->instances[$abstract];
    }
}
