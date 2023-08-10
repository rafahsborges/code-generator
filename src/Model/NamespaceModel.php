<?php

namespace RafahSBorges\CodeGenerator\Model;

use RafahSBorges\CodeGenerator\RenderableModel;

/**
 * Class PHPClassNamespace
 * @package RafahSBorges\CodeGenerator\Model
 */
class NamespaceModel extends RenderableModel
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * PHPClassNamespace constructor.
     * @param string $namespace
     */
    public function __construct($namespace)
    {
        $this->setNamespace($namespace);
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        return sprintf('namespace %s;', $this->namespace);
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }
}
