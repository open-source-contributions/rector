<?php declare(strict_types=1);

namespace Rector\DependencyInjection\CompilerPass;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use Rector\Contract\Dispatcher\ReconstructorInterface;
use Rector\Dispatcher\NodeDispatcher;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symplify\PackageBuilder\Adapter\Symfony\DependencyInjection\DefinitionCollector;

final class CollectorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $containerBuilder): void
    {
        $this->collectCommandsToConsoleApplication($containerBuilder);
        $this->collectNodeVisitorsToTraverser($containerBuilder);
    }

    private function collectCommandsToConsoleApplication(ContainerBuilder $containerBuilder): void
    {
        DefinitionCollector::loadCollectorWithType(
            $containerBuilder,
            Application::class,
            Command::class,
            'add'
        );
    }

    private function collectNodeVisitorsToTraverser(ContainerBuilder $containerBuilder): void
    {
        DefinitionCollector::loadCollectorWithType(
            $containerBuilder,
            NodeTraverser::class,
            NodeVisitor::class,
            'addVisitor'
        );
    }
}
