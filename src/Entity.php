<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Entities;

abstract class Entity implements EntityInterface
{
    /**
     * @param array<string, mixed> $properties
     */
    public function __construct(array $properties = [])
    {
        $this->hydrate($properties);
    }

    /**
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        $this->{$name} = $value;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    /**
     * @param array<int> $arguments
     *
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        if (\count($arguments)) {
            $this->__set($name, $arguments[0]);
        }

        return $this->__get($name);
    }

    /**
     * Entity to json string
     *
     * @return string
     */
    public function __toString()
    {
        return \json_encode(\array_filter($this->toArray()), \JSON_ERROR_NONE) ?: '';
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return \get_object_vars($this);
    }

    /**
     * @param  array<string> $properties
     */
    private function hydrate(array $properties): void
    {
        foreach ($properties as $property => $value) {
            if (\property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
