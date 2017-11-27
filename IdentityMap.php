<?php

namespace AppBundle\XmlImporter\IdentityMap;

class IdentityMap implements IdentityMapInterface
{
    private $stack;

    /**
     * @param IdentityInterface $object
     */
    public function addInstance(IdentityInterface $object)
    {
        $this->stack[get_class($object)][$object->getId()] = $object;
    }

    /**
     * @param string $type
     * @param int $id
     * @return AbstractIdentity
     */
    public function getInstance($type, $id)
    {
        return ($this->has($type, $id) ? $this->stack[$type][$id] : null);
    }

    /**
     * @param string $type
     * @param int $id
     * @return bool
     */
    public function has($type, $id)
    {
        return isset($this->stack[$type][$id]);
    }

    /**
     * @param string $type
     * @param int $id
     */
    public function detach($type, $id)
    {
        $this->stack[$type][$id] = null;
    }

    /**
     * @param SpecificationInterface $specification
     * @return mixed
     */
    public function find(SpecificationInterface $specification)
    {
        // nothing to see, move along
        if (empty($this->stack)) {
            return null;
        }
        $results = [];
        foreach ($this->stack as $type) {
            foreach ($type as $object) {
                if ($specification->eligible($object)) {
                    $results[] = $object;
                }
            }
        }
    }

    /**
     * @param SpecificationInterface $specification
     * @return mixed
     */
    public function deleteBySpecification(SpecificationInterface $specification)
    {
        // nothing to see, move along
        if (empty($this->stack)) {
            return null;
        }

        foreach ($this->stack as $keyType => $type) {
            foreach ($type as $key => $object) {
                if ($specification->eligible($object)) {
                    unset($this->stack[$keyType][$key]);
                }
            }
        }
    }

    /**
     * @return void
     */
    public function detachAll()
    {
        $this->stack = null;
    }
}
