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
     * Save attribute names hydrate on instance
     *
     * @var array<string>
     */
    private $attributesHydrated = [];

    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->hydrate($attributes);
    }

    /**
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        $this->{$name} = $value;

        $this->attributesHydrated[] = $name;
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
        $attribute = $this->snakeCase($name);

        if (\count($arguments)) {
            $this->__set($attribute, $arguments[0]);
        }

        return $this->__get($attribute);
    }

    /**
     * Entity to json string
     *
     * @return string
     */
    public function __toString()
    {
        return (string)\json_encode($this->toArray(), \JSON_ERROR_NONE);
    }

    /**
     * @return array<string>
     */
    public function toArray(): array
    {
        $toArray = [];

        \array_map(function ($attribute) use (&$toArray): void {
            if (\property_exists($this, $attribute)) {
                $toArray[$this->camelCase($attribute)] = $this->{$attribute};
            }
        }, $this->attributesHydrated);

        return $toArray;
    }

    /**
     * @param  array<string> $attributes
     *
     * @return $this
     */
    private function hydrate(array $attributes): self
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$this->snakeCase($attribute)} = $value;
        }

        return $this;
    }

    /**
     * Change to snake_case attribute name
     */
    private function snakeCase(string $attribute): string
    {
        return \mb_strtolower(\preg_replace('~(?<=\\w)([A-Z])~', '_$1', $attribute) ?? $attribute);
    }

    /**
     * Change to camelCase attribute name
     */
    private function camelCase(string $attribute): string
    {
        $string = \preg_replace_callback('/_(.?)/', function ($matches) {
            return \ucfirst($matches[1]);
        }, $attribute);

        return $string ?? $attribute;
    }
}
