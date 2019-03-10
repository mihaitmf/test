<?php

namespace GraphTraversal;

$startTime = microtime(true);

$input = trim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "input-graph-traversal.txt"));
$result = solve($input);
print($result);
print(sprintf(
    "\n\nExecution time: %.4f seconds\nMemory peak usage: %.2f MB\n",
    microtime(true) - $startTime,
    memory_get_peak_usage(true) / 1024 / 1024
));

function solve($input)
{
    $traverseSequences = ['', '', '', ''];

    $nodesSet = parseInputIntoStructure($input);
    traverseGraphDepthFirstSearchRecursive($nodesSet['A'], $traverseSequences[0]);

    $nodesSet = parseInputIntoStructure($input);
    traverseGraphDepthFirstSearchIterative($nodesSet['A'], $traverseSequences[1]);

    $nodesSet = parseInputIntoStructure($input);
    $queue = [$nodesSet['A']];
    traverseGraphBreadthFirstSearchRecursive($queue, $traverseSequences[2]);

    $nodesSet = parseInputIntoStructure($input);
    traverseGraphBreadthFirstSearchIterative($nodesSet['A'], $traverseSequences[3]);

    return implode("\r\n", $traverseSequences);
}

function traverseGraphDepthFirstSearchRecursive(Node $node, &$traverseSequence) {
    $node->setVisited();

    if ($traverseSequence !== '') {
        $traverseSequence .= ' - ';
    }
    $traverseSequence .= $node->getName();

    $neighbours = $node->getNeighbours();
    foreach ($neighbours as $neighbourNode) {
        if (!$neighbourNode->isVisited()) {
            traverseGraphDepthFirstSearchRecursive($neighbourNode, $traverseSequence);
        }
    }
}

function traverseGraphDepthFirstSearchIterative(Node $node, &$traverseSequence) {
    $stack = [$node];

    while ($stack !== []) {
        $node = array_pop($stack);

        if (!$node->isVisited()) {
            $node->setVisited();

            if ($traverseSequence !== '') {
                $traverseSequence .= ' - ';
            }
            $traverseSequence .= $node->getName();

            $neighbours = $node->getNeighbours();
            for ($i = count($neighbours) - 1; $i >= 0; $i--) {
                $stack[] = $neighbours[$i];
            }
        }
    }
}

function traverseGraphBreadthFirstSearchRecursive(array &$queue, &$traverseSequence) {
    if ($queue === []) {
        return;
    }

    $node = array_shift($queue);

    if (!$node->isVisited()) {
        $node->setVisited();

        if ($traverseSequence !== '') {
            $traverseSequence .= ' - ';
        }
        $traverseSequence .= $node->getName();

        $neighbours = $node->getNeighbours();
        foreach ($neighbours as $neighbourNode) {
            $queue[] = $neighbourNode;
        }
    }

    traverseGraphBreadthFirstSearchRecursive($queue, $traverseSequence);
}

function traverseGraphBreadthFirstSearchIterative(Node $node, &$traverseSequence) {
    $queue = [$node];

    while ($queue !== []) {
        $node = array_shift($queue);

        if (!$node->isVisited()) {
            $node->setVisited();

            if ($traverseSequence !== '') {
                $traverseSequence .= ' - ';
            }
            $traverseSequence .= $node->getName();

            $neighbours = $node->getNeighbours();
            foreach ($neighbours as $neighbourNode) {
                $queue[] = $neighbourNode;
            }
        }
    }
}

/**
 * @param string $input
 *
 * @return Node[]
 */
function parseInputIntoStructure($input) {
    /** @var Node[] $nodesSet */
    $nodesSet = [];

    $rows = explode("\n", $input);
    foreach ($rows as $rowIndex => $row) {
        $items = explode(" ", $row);
        $nodeFrom = $items[0];
        $nodeTo = $items[1];

        if (!array_key_exists($nodeFrom, $nodesSet)) {
            $nodesSet[$nodeFrom] = new Node($nodeFrom);
        }
        if (!array_key_exists($nodeTo, $nodesSet)) {
            $nodesSet[$nodeTo] = new Node($nodeTo);
        }

        $nodesSet[$nodeFrom]->addNeighbour($nodesSet[$nodeTo]);
        $nodesSet[$nodeTo]->addNeighbour($nodesSet[$nodeFrom]);
    }

    return $nodesSet;
}

class Node {
    /** @var string */
    private $name;

    /** @var bool */
    private $visited;

    /** @var Node[] */
    private $neighbours;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->visited = false;
        $this->neighbours = [];
    }

    public function setVisited()
    {
        $this->visited = true;
    }

    /**
     * @param Node $neighbour
     */
    public function addNeighbour(Node $neighbour)
    {
        $this->neighbours[$neighbour->getName()] = $neighbour;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isVisited()
    {
        return $this->visited;
    }

    /**
     * @return Node[]
     */
    public function getNeighbours()
    {
        return array_values($this->neighbours);
    }
}
