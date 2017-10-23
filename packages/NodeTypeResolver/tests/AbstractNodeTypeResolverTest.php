<?php declare(strict_types=1);

namespace Rector\NodeTypeResolver\Tests;

use PhpParser\Node;
use PhpParser\NodeFinder;
use Rector\NodeTraverserQueue\NodeTraverserQueue;
use Rector\Tests\AbstractContainerAwareTestCase;
use SplFileInfo;

abstract class AbstractNodeTypeResolverTest extends AbstractContainerAwareTestCase
{
    /**
     * @var NodeFinder
     */
    protected $nodeFinder;

    /**
     * @var NodeTraverserQueue
     */
    private $nodeTraverserQueue;

    protected function setUp(): void
    {
        $this->nodeFinder = $this->container->get(NodeFinder::class);
        $this->nodeTraverserQueue = $this->container->get(NodeTraverserQueue::class);
    }

    /**
     * @return Node[]
     */
    protected function getNodesWithTypesForFile(string $file): array
    {
        $fileInfo = new SplFileInfo($file);

        [$newStmts,] = $this->nodeTraverserQueue->processFileInfo($fileInfo);

        return $newStmts;
    }
}
