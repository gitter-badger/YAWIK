<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2015 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** Core models */
namespace Core\Entity;

/**
 * Model interface
 */
interface IdentifiableEntityInterface
{

    /**
     * Sets the id.
     *
     * @param mixed $id
     */
    public function setId($id);
    
    /**
     * Gets the id.
     *
     * @return mixed
     */
    public function getId();
}
