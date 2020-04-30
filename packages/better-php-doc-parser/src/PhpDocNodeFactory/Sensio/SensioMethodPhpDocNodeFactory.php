<?php

declare(strict_types=1);

namespace Rector\BetterPhpDocParser\PhpDocNodeFactory\Sensio;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use Rector\BetterPhpDocParser\PhpDocNode\Sensio\SensioMethodTagValueNode;
use Rector\BetterPhpDocParser\PhpDocNodeFactory\AbstractPhpDocNodeFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

final class SensioMethodPhpDocNodeFactory extends AbstractPhpDocNodeFactory
{
    /**
     * @return string[]
     */
    public function getClasses(): array
    {
        return [Method::class];
    }

    /**
     * @return SensioMethodTagValueNode|null
     */
    public function createFromNodeAndTokens(
        Node $node,
        TokenIterator $tokenIterator,
        string $annotationClass
    ): ?PhpDocTagValueNode {
        if (! $node instanceof ClassMethod) {
            return null;
        }

        /** @var Method|null $method */
        $method = $this->nodeAnnotationReader->readMethodAnnotation($node, $annotationClass);
        if ($method === null) {
            return null;
        }

        // to skip tokens for this node
        $content = $this->resolveContentFromTokenIterator($tokenIterator);

        return new SensioMethodTagValueNode($method, $content);
    }
}
