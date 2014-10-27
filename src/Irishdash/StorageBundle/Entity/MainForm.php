<?php
/**
 * Created by PhpStorm.
 * User: irishdash
 * Date: 23.10.14
 * Time: 22:30
 */

namespace Irishdash\StorageBundle\Entity;

/**
 * Class MainForm
 * Getters and setters for main page form
 *
 * @package Irishdash\StorageBundle\Entity
 */
class MainForm
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $type;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
} 