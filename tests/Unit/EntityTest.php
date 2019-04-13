<?php

namespace FlexPHP\Entities\Tests\Unit;

use FlexPHP\Entities\Entity;
use FlexPHP\Entities\EntityInterface;
use FlexPHP\Entities\Tests\Mocks\EntityMock;
use FlexPHP\Entities\Tests\TestCase;

class EntityTest extends TestCase
{
    public function testItUseInterface()
    {
        $entity = new EntityMock();

        $this->assertInstanceOf(EntityInterface::class, $entity);
    }

    public function testItInitializeWithoutAttributes()
    {
        $entity = new EntityMock();

        $this->assertSame(null, $entity->foo());
        $this->assertSame(null, $entity->bar());
        $this->assertSame([], $entity->toArray());
        $this->assertEquals(json_encode([]), $entity);
    }

    public function testItInitializeWithEmptyAttributes()
    {
        $this->markTestSkipped();
        $entity = new EntityMock([]);

        $this->assertSame(null, $entity->foo());
        $this->assertSame(null, $entity->bar());
        $this->assertSame([], $entity->toArray());
        $this->assertEquals(json_encode([]), $entity);
    }

    public function testItInitializeWithBoolTrueAttribute()
    {
        $foo = true;

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithBoolFalseAttribute()
    {
        $foo = false;

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithNullAttribute()
    {
        $foo = null;

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithStringAttribute()
    {
        $foo = (string)'bar';

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithIntAttribute()
    {
        $foo = (int)rand(1, 9);

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithFloatAttribute()
    {
        $foo = microtime(true);

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItSetAttributeInChain()
    {
        $foo = 'foo';
        $bar = 'bar';

        $entity = new EntityMock();
        $entity->foo($foo)->bar($bar);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($bar, $entity->bar());
    }

    public function testItGetAsString()
    {
        $foo = 'foo';
        $bar = 'bar';

        $entity = new EntityMock();
        $entity->foo($foo)->bar($bar);

        $this->assertEquals(json_encode(compact('foo', 'bar')), $entity);
    }
}
