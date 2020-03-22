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
 * @method $this|string foo($foo = null)
 * @method $this|string bar($bar = null)
 * @method $this|string fooBar($fooBar = null)
 */
class EntityMock extends Entity
{
}
