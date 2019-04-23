<?php

namespace FlexPHP\Entities;

/**
 * Interface EntityInterface
 * @package FlexPHP\Entities
 */
interface EntityInterface
{
    /**
     * Get attributes as array
     *
     * @return array
     */
    public function toArray(): array;
}
