<?php

namespace FlexPHP\Entities;

/**
 * Class Entity
 *
 * @method $this|int id($id = null)
 */
abstract class Entity implements EntityInterface
{
    /**
     * Save attribute names hydrate on instance
     *
     * @var array
     */
    private $attributesHydrated = [];

    /**
     * Entity constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->hydrate($attributes);
    }

    public function getKeyName(): string
    {
        return 'id';
    }

    public function toArray(): array
    {
        $toArray = [];

        foreach ($this->attributesHydrated as $attribute) {
            if (property_exists($this, $attribute)) {
                $toArray[$attribute] = $this->{$attribute};
            }
        }

        return $toArray;
    }

    /**
     * @param  array $attributes
     * @return $this
     */
    private function hydrate(array $attributes): self
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$attribute} = $value;
        }

        return $this;
    }

    /**
     * @param  $name
     * @param  $value
     * @return $this
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;

        $this->attributesHydrated[] = $name;

        return $this;
    }

    /**
     * @param  $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    /**
     * @param  $name
     * @param  $arguments
     * @return $this|mixed
     */
    public function __call($name, $arguments)
    {
        $attribute = $this->snakeCase($name);

        if (count($arguments) > 0) {
            return self::__set($attribute, ...$arguments);
        }

        return self::__get($attribute);
    }

    /**
     * Entity to json string
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->toArray(), 0);
    }

    /**
     * Change to snake_case attribute names
     *
     * @param string $attribute
     * @return string
     */
    private function snakeCase(string $attribute): string
    {
        return \mb_strtolower(\preg_replace('~(?<=\\w)([A-Z])~', '_$1', $attribute));
    }
}
