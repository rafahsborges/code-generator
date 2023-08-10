<?php

namespace RafahSBorges\CodeGenerator\Model;

use RafahSBorges\CodeGenerator\RenderableModel;

/**
 * Class BaseProperty
 * @package RafahSBorges\CodeGenerator\Model
 */
abstract class BasePropertyModel extends RenderableModel
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
