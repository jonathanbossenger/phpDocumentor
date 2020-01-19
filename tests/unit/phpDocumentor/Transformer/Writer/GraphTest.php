<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link http://phpdoc.org
 */

namespace phpDocumentor\Transformer\Writer;

use phpDocumentor\Transformer\Writer\Graph\GraphVizClassDiagram;
use phpDocumentor\Transformer\Writer\Graph\PlantumlClassDiagram;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

final class GraphTest extends TestCase
{
    /** @var Graph */
    private $graph;

    protected function setUp() : void
    {
        $this->graph = new Graph(new GraphVizClassDiagram(), new PlantumlClassDiagram(new NullLogger()));
    }

    public function testItExposesCustomSettingToEnableGraphs()
    {
        $this->assertSame(['graphs.enabled' => false], $this->graph->getDefaultSettings());
    }
}
