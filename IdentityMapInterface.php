<?php

namespace AppBundle\XmlImporter\IdentityMap;

interface IdentityMapInterface
{
    /**
     * @param IdentityInterface $object
     */
    public function addInstance(IdentityInterface $object);

    /**
     * @param string $type
     * @param int $id
     * @return IdentityInterface
     */
    public function getInstance($type, $id);

    /**
     * @param string $type
     * @param int $id
     * @return bool
     */
    public function has($type, $id);

    /**
     * @param string $type
     * @param int $id
     */
    public function detach($type, $id);

    /**
     * @return void
     */
    public function detachAll();

    /**
     * @param SpecificationInterface $specification
     * @return IdentityInterface[]
     */
    public function find(SpecificationInterface $specification);

    /**
     * @param SpecificationInterface $specification
     */
    public function deleteBySpecification(SpecificationInterface $specification);
}
