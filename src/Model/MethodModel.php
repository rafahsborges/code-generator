<?php

namespace RafahSBorges\CodeGenerator\Model;

use RafahSBorges\CodeGenerator\Exception\ValidationException;
use RafahSBorges\CodeGenerator\Model\Traits\AbstractModifierTrait;
use RafahSBorges\CodeGenerator\Model\Traits\AccessModifierTrait;
use RafahSBorges\CodeGenerator\Model\Traits\DocBlockTrait;
use RafahSBorges\CodeGenerator\Model\Traits\FinalModifierTrait;
use RafahSBorges\CodeGenerator\Model\Traits\StaticModifierTrait;

/**
 * Class PHPClassMethod
 * @package RafahSBorges\CodeGenerator\Model
 */
class MethodModel extends BaseMethodModel
{
    use AbstractModifierTrait;
    use AccessModifierTrait;
    use DocBlockTrait;
    use FinalModifierTrait;
    use StaticModifierTrait;

    /**
     * @var string
     */
    protected $body;

    /**
     * MethodModel constructor.
     * @param string $name
     * @param string $access
     */
    public function __construct($name, $access = 'public')
    {
        $this->setName($name)
            ->setAccess($access);
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        $lines = [];
        if ($this->docBlock !== null) {
            $lines = array_merge($lines, $this->docBlock->toLines());
        }

        $function = '';
        if ($this->final) {
            $function .= 'final ';
        }
        if ($this->abstract) {
            $function .= 'abstract ';
        }
        $function .= $this->access . ' ';
        if ($this->static) {
            $function .= 'static ';
        }

        $function .= 'function ' . $this->name . '(' . $this->renderArguments() . ')';

        if ($this->abstract) {
            $function .= ';';
        }

        $lines[] = $function;
        if (!$this->abstract) {
            $lines[] = '{';
            if ($this->body) {
                $lines[] = sprintf('    %s', $this->body); // TODO: make body renderable
            }
            $lines[] = '}';
        }

        return $lines;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function validate()
    {
        if ($this->abstract and ($this->final or $this->static)) {
            throw new ValidationException('Entity cannot be abstract and final or static at the same time');
        }

        return parent::validate();
    }
}
