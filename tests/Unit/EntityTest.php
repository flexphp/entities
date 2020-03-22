<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Entities\Tests\Unit;

use FlexPHP\Entities\EntityInterface;
use FlexPHP\Entities\Tests\Mocks\EntityMock;
use FlexPHP\Entities\Tests\TestCase;

class EntityTest extends TestCase
{
    public function testItUseInterface(): void
    {
        $entity = new EntityMock();

        $this->assertInstanceOf(EntityInterface::class, $entity);
    }

    public function testItInitializeWithoutAttributes(): void
    {
        $entity = new EntityMock();

        $this->assertSame(null, $entity->foo());
        $this->assertSame(null, $entity->bar());
        $this->assertSame([], $entity->toArray());
        $this->assertEquals(\json_encode([]), $entity);
    }

    public function testItInitializeWithEmptyAttributes(): void
    {
        $entity = new EntityMock([]);

        $this->assertSame(null, $entity->foo());
        $this->assertSame(null, $entity->bar());
        $this->assertSame([], $entity->toArray());
        $this->assertEquals(\json_encode([]), (string)$entity);
    }

    public function testItInitializeWithBoolTrueAttribute(): void
    {
        $foo = true;

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithBoolFalseAttribute(): void
    {
        $foo = false;

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithNullAttribute(): void
    {
        $foo = null;

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithStringAttribute(): void
    {
        $foo = (string)'bar';

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithMbStringAttribute(): void
    {
        $foo = (string)'漢字はユニコード';

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithIntAttribute(): void
    {
        $foo = (int)\rand(1, 9);

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithFloatAttribute(): void
    {
        $foo = \microtime(true);

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithEmptyArrayAttribute(): void
    {
        $foo = [];

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithArrayAttribute(): void
    {
        $foo = ['foo', 'bar'];

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithKeyArrayAttribute(): void
    {
        $foo = ['foo' => 'bar'];

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeStdClassEmptyAttribute(): void
    {
        $foo = new \stdClass;

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeStdClassAttribute(): void
    {
        $foo = new \stdClass;
        $foo->bar = 'bar';
        $foo->baz = 'baz';

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeClosureAttribute(): void
    {
        $foo = function () {
            return \microtime();
        };

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeClassAttribute(): void
    {
        $foo = new \Exception('Test');

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithDateTimeAttribute(): void
    {
        $foo = new \DateTime();

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithDateTimeImmutableAttribute(): void
    {
        $foo = new \DateTimeImmutable();

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithDateIntervalAttribute(): void
    {
        $foo = new \DateInterval('P1M');

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithDateTimeZoneAttribute(): void
    {
        $foo = new \DateTimeZone('UTC');

        $entity = new EntityMock([
            'foo' => $foo,
        ]);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItInitializeWithCamelCaseAttribute(): void
    {
        $fooBar = 'fooBar';

        $entity = new EntityMock([
            'fooBar' => $fooBar,
        ]);

        $this->assertSame($fooBar, $entity->fooBar());
        $this->assertSame($fooBar, $entity->toArray()['fooBar']);
    }

    public function testItSetAttribute(): void
    {
        $foo = 'foo';

        $entity = new EntityMock();
        $entity->foo($foo);

        $this->assertSame($foo, $entity->foo());
        $this->assertSame($foo, $entity->toArray()['foo']);
    }

    public function testItSetCamelCaseAttribute(): void
    {
        $fooBar = 'fooBar';

        $entity = new EntityMock();
        $entity->fooBar($fooBar);

        $this->assertSame($fooBar, $entity->fooBar());
        $this->assertSame($fooBar, $entity->toArray()['fooBar']);
    }

    public function testItSetPascalCaseAttribute(): void
    {
        $FooBar = 'FooBar';

        $entity = new EntityMock();
        $entity->FooBar($FooBar);

        $this->assertSame($FooBar, $entity->FooBar());
        $this->assertSame($FooBar, $entity->toArray()['fooBar']);
    }

    public function testItSetUpperCaseAttribute(): void
    {
        $FOOBAR = 'FOOBAR';

        $entity = new EntityMock();
        $entity->FOOBAR($FOOBAR);

        $this->assertSame($FOOBAR, $entity->FOOBAR());
        $this->assertSame($FOOBAR, $entity->toArray()['fOOBAR']);
    }

    public function testItGetAsString(): void
    {
        $foo = 'foo';
        $bar = 'bar';

        $entity = new EntityMock();
        $entity->foo($foo);
        $entity->bar($bar);

        $this->assertEquals(\json_encode(\compact('foo', 'bar')), $entity);
    }
}
