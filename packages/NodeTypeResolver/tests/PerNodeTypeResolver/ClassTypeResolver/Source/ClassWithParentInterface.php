<?php declare(strict_types=1);

namespace Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\ClassTypeResolver\Source;

final class ClassWithParentInterface implements SomeInterface
{

}

$someClass = new ClassWithParentInterface();