<?php

namespace AppBundle\XmlImporter\IdentityMap;

/**
 * Layer Super type
 */
interface IdentityInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);
}
