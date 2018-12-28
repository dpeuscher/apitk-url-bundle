<?php

namespace Shopping\ApiTKUrlBundle\Repository;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use LogicException;

/**
 * @category  apitk-url-bundle
 * @copyright Copyright (c) 2018 Dominik Peuscher
 */
class ServiceApiToolkitRepository extends ApiToolkitRepository
{
    /**
     * @param ManagerRegistry $registry
     * @param string $entityClass The class name of the entity this repository manages
     */
    public function __construct(ManagerRegistry $registry, $entityClass)
    {
        /** @var EntityManager $manager */
        $manager = $registry->getManagerForClass($entityClass);

        if ($manager === null) {
            throw new LogicException(sprintf(
                'Could not find the entity manager for class "%s". Check your Doctrine configuration to make sure it is configured to load this entity’s metadata.',
                $entityClass
            ));
        }

        parent::__construct($manager, $manager->getClassMetadata($entityClass));
    }
}
