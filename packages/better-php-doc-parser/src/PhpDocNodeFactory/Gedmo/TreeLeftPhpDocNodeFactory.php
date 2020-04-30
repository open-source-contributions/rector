<?php

declare(strict_types=1);

namespace Rector\BetterPhpDocParser\PhpDocNodeFactory\Gedmo;

use Gedmo\Mapping\Annotation\Blameable;
use Gedmo\Mapping\Annotation\TreeLeft;
use PhpParser\Node;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use Rector\BetterPhpDocParser\PhpDocNode\Gedmo\TreeLeftTagValueNode;
use Rector\BetterPhpDocParser\PhpDocNodeFactory\AbstractBasicPropertyPhpDocNodeFactory;

final class TreeLeftPhpDocNodeFactory extends AbstractBasicPropertyPhpDocNodeFactory
{
    /**
     * @return string[]
     */
    public function getClasses(): array
    {
        return [TreeLeft::class];
    }

    /**
     * @return TreeLeftTagValueNode|null
     */
    public function createFromNodeAndTokens(
        Node $node,
        TokenIterator $tokenIterator,
        string $annotationClass
    ): ?PhpDocTagValueNode {
        if (! $node instanceof Property) {
            return null;
        }

        /** @var Blameable|null $blameable */
        $blameable = $this->nodeAnnotationReader->readPropertyAnnotation($node, $annotationClass);
        if ($blameable === null) {
            return null;
        }

        return new TreeLeftTagValueNode($blameable);
    }

    protected function getTagValueNodeClass(): string
    {
        return TreeLeftTagValueNode::class;
    }
}
