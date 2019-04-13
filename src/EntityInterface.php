<?php

namespace FlexPHP\Entities;

interface EntityInterface
{
    /**
     * Attribute name for identifier unique (PK)
     *
     * @return string
     */
    public function getKeyName(): string;

    /**
     * Get attributes as array
     *
     * @return array
     */
    public function toArray(): array;
}
