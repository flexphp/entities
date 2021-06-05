<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Entities\Tests\Mocks;

use FlexPHP\Entities\Entity;

/**
 * @method mixed foo($foo = null)
 * @method mixed bar($bar = null)
 * @method mixed fooBar($fooBar = null)
 * @method mixed FooBar($FooBar = null)
 * @method mixed FOOBAR($FOOBAR = null)
 * @method mixed foo_bar($foo_bar = null)
 */
final class EntityMock extends Entity
{
    /**
     * @var mixed
     */
    protected $foo;

    /**
     * @var mixed
     */
    protected $bar;

    /**
     * @var mixed
     */
    protected $fooBar;

    /**
     * @var mixed
     */
    protected $FooBar;

    /**
     * @var mixed
     */
    protected $FOOBAR;
}
