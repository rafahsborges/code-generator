<?php

namespace RafahSBorges\CodeGenerator;

/**
 * Interface LineableInterface
 * @package RafahSBorges\CodeGenerator
 */
interface LineableInterface
{
    /**
     * @return string|string[]
     */
    public function toLines();
}