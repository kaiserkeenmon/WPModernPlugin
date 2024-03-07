<?php

namespace WPModernPlugin\Service;

use WPModernPlugin\Repository\AnotherGreatererServiceRepositoryInterface;

class AnotherGreatererService implements AnotherGreatererServiceInterface {

    /** @var AnotherGreatererServiceRepositoryInterface */
    protected $anotherGreatererServiceRepository;

    public function __construct(AnotherGreatererServiceRepositoryInterface $anotherGreatererServiceRepository) {
        $this->anotherGreatererServiceRepository = $anotherGreatererServiceRepository;
    }

    /**
     * Example method.
     *
     * Modify this stub to fit your service's needs.
     *
     * @param mixed $parameter Description of the parameter
     * @return mixed
     */
    public function exampleMethod($parameter) {
        // Implement method functionality here
        // Example: return $this->anotherGreatererServiceRepository->find($parameter);
    }
}