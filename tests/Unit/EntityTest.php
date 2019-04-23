<?php

namespace FlexPHP\Entities\Tests\Unit;

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
        $entity = new EntityMock([]);

        $this->assertSame(null, $entity->foo());
        $this->assertSame(null, $entity->bar());
        $this->assertSame([], $entity->toArray());
        $this->assertEquals(json_encode([]), (string)$entity);
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

    public function testItInitializeWithEmptyArrayAttribute()
    {
        $foo = [];

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithArrayAttribute()
    {
        $foo = ['foo', 'bar'];

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithKeyArrayAttribute()
    {
        $foo = ['foo' => 'bar'];

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithCamelCaseAttribute()
    {
        $fooBar = 'fooBar';

        $entity = new EntityMock([
            'fooBar' => $fooBar,
        ]);

        $this->assertSame($fooBar, $entity->fooBar());
        $this->assertSame($fooBar, $entity->toArray()['fooBar']);
    }

    public function testItSetAttribute()
    {
        $foo = 'foo';

        $entity = new EntityMock();
        $entity->foo($foo);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItSetCamelCaseAttribute()
    {
        $fooBar = 'fooBar';

        $entity = new EntityMock();
        $entity->fooBar($fooBar);

        $this->assertSame($fooBar, $entity->fooBar());
        $this->assertSame($fooBar, $entity->toArray()['fooBar']);
    }

    public function testItSetAttributeInChain()
    {
        $foo = 'foo';
        $bar = 1;
        $fooBar = true;

        $entity = new EntityMock();
        $entity->foo($foo)->bar($bar)->fooBar($fooBar);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($bar, $entity->bar());
        $this->assertSame($fooBar, $entity->fooBar());
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
