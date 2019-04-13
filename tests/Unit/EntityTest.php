<?php

namespace FlexPHP\Entities\Tests\Unit;

use FlexPHP\Entities\Entity;
use FlexPHP\Entities\Tests\Mocks\EntityMock;
use FlexPHP\Entities\Tests\TestCase;

class EntityTest extends TestCase
{
    public function testItInitializeWithoutAttributes()
    {
        $entity = new EntityMock();

        $this->assertInstanceOf(Entity::class, $entity);
    }

    public function testItInitializeWithEmptyAttributes()
    {
        $entity = new EntityMock([]);

        $this->assertInstanceOf(Entity::class, $entity);
    }

    public function testItInitializeWithStringAttribute()
    {
        $value = (string)'bar';

        $entity = new EntityMock([
            'foo' => $value,
        ]);

        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertEquals($value, $entity->foo());
        $this->assertEquals($value, $entity->toArray()['foo']);
    }

    public function testItInitializeWithIntAttribute()
    {
        $value = (int)rand(1, 9);

        $entity = new EntityMock([
            'foo' => $value,
        ]);

        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertEquals($value, $entity->foo());
        $this->assertEquals($value, $entity->toArray()['foo']);
    }
}
