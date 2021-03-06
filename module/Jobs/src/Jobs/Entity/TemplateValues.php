<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2015 Cross Solution (http://cross-solution.de)
 * @license   MIT
 * @author    weitz@cross-solution.de
 */

namespace Jobs\Entity;

use Core\Entity\AbstractIdentifiableHydratorAwareEntity;
use Core\Entity\AbstractEntity;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Holds various fields a o job opening template
 *
 * @ODM\EmbeddedDocument
 */
class TemplateValues extends AbstractEntity
{

    /**
     * Qualification field of the job template
     *
     * @var String
     * @ODM\String
     */
    protected $qualifications;

    /**
     * Requirements field of the job template
     *
     * @var String
     * @ODM\String
     */
    protected $requirements;

    /**
     * Benefits field of the job template
     *
     * @var String
     * @ODM\String
     */
    protected $benefits;

    /**
     * Job title field of the job template
     *
     * @var String
     * @ODM\String
     */
    protected $title;

    /**
     * free values (currently not in use)
     *
     * @ODM\Hash
     */
    protected $_freeValues;

    /**
     * Sets the Qualification field of the job template
     *
     * @param $qualifications
     * @return $this
     */
    public function setQualifications($qualifications)
    {
        $this->qualifications= (string) $qualifications;
        return $this;
    }

    /**
     * Gets the qualification of a job template
     *
     * @return String
     */
    public function getQualifications()
    {
        return $this->qualifications;
    }

    /**
     * Sets the requirements of a job template
     *
     * @param String $requirements
     * @return $this
     */
    public function setRequirements($requirements)
    {
        $this->requirements=(string) $requirements;
        return $this;
    }

    /**
     * Gets the requirements of a job template
     *
     * @return String
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Sets the benefits of a job template
     *
     * @param String $benefits
     * @return $this
     */
    public function setBenefits($benefits)
    {
        $this->benefits=(string) $benefits;
        return $this;
    }

    /**
     * Gets the Benefits of a job template
     *
     * @return String
     */
    public function getBenefits()
    {
        return $this->benefits;
    }

    /**
     * Sets the job title of the job template
     *
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title=(string) $title;
        return $this;
    }

    /**
     * Gets the job title of the job template
     *
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $key
     * @param null $default
     * @param bool $set
     * @return null
     */
    public function get($key = null, $default = null, $set = false)
    {
        if (isset($this->_freeValues[$key])) {
            return $this->_freeValues[$key];
        }
        if ($set) {
            $this->set($key, $default);
        }
        return $default;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        //$this->checkWriteAccess();
        $this->_freeValues[$key] = $value;
        return $this;
    }

    public function __get($property)
    {
        $getter = "get" . ucfirst($property);
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }

        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return $this->get($property);
    }

    public function __set($property, $value)
    {
        //$this->checkWriteAccess();
        $setter = 'set' . ucfirst($property);
        if (method_exists($this, $setter)) {
            $this->$setter($value);
            return;
        }

        if (property_exists($this, $property)) {
            $this->$property = $value;
            return;
        }

        $this->set($property, $value);
    }

    public function __isset($property)
    {
        $value = $this->__get($property);

        if (is_array($value) && !count($value)) {
            return false;
        }
        if (is_bool($value) || is_object($value)) {
            return true;
        }
        return (bool) $value;
    }
}
