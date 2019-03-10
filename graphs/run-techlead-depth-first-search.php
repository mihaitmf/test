<?php

namespace TechLead;

use ArrayAccess;
use ArrayObject;
use Exception;

$startTime = microtime(true);

$input = trim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "input-techlead.txt"));
$result = solve($input);
print($result);
print(sprintf(
    "\n\nExecution time: %.4f seconds\nMemory peak usage: %.2f MB\n",
    microtime(true) - $startTime,
    memory_get_peak_usage(true) / 1024 / 1024
));

function solve($input)
{
    // find the graph with the biggest size (with the most connected nodes)

    list($nodesMap, $n, $m) = parseInputIntoStructure($input);
    $graphSizes = new GraphSizes();

    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $m; $j++) {
            traverseGraphDepthFirst($i, $j, $nodesMap->get($i, $j)->getValue(), $nodesMap, $graphSizes);
        }
    }

    $maxSize = 0;
    $graphIdWithMaxSize = '';
    foreach ($graphSizes as $graphId => $size) {
        if ($size > $maxSize) {
            $maxSize = $size;
            $graphIdWithMaxSize = $graphId;
        }
    }

    return $graphIdWithMaxSize . ' => ' . $maxSize;
}

function traverseGraphDepthFirst($x, $y, $nodeValueToSearch, NodesMap $nodesMap, ArrayAccess $graphSizes) {
    try {
        $node = $nodesMap->get($x, $y);
    } catch (Exception $exception) {
        return;
    }

    $nodeValue = $node->getValue();

    if ($nodeValue !== $nodeValueToSearch || $node->isVisited()) {
        return;
    }

    $node->setVisited();

    if ($graphSizes->offsetExists($nodeValue)) {
        $graphSizes->offsetSet($nodeValue, $graphSizes->offsetGet($nodeValue) + 1);
    } else {
        $graphSizes->offsetSet($nodeValue, 1);
    }

    traverseGraphDepthFirst($x, $y + 1, $nodeValueToSearch, $nodesMap, $graphSizes); // go right
    traverseGraphDepthFirst($x + 1, $y, $nodeValueToSearch, $nodesMap, $graphSizes); // go down
    traverseGraphDepthFirst($x, $y - 1, $nodeValueToSearch, $nodesMap, $graphSizes); // go left
    traverseGraphDepthFirst($x - 1, $y, $nodeValueToSearch, $nodesMap, $graphSizes); // go up
}

/**
 * @param string $input
 *
 * @return array [NodesMap, int, int]
 */
function parseInputIntoStructure($input)
{
    $nodesMap = new NodesMap();

    $rows = explode("\n", $input);

    $rowsCount = count($rows);
    $columnsCount = 0;

    foreach ($rows as $rowIndex => $row) {
        $items = explode(" ", $row);

        $currentColumnsCount = count($items);
        if ($currentColumnsCount > $columnsCount) {
            $columnsCount = $currentColumnsCount;
        }

        foreach ($items as $itemIndex => $item) {
            $nodesMap->add($rowIndex, $itemIndex, new Node($item));
        }
    }

    return [$nodesMap, $rowsCount - 1, $columnsCount - 1];
}

class GraphSizes extends ArrayObject {}

class NodesMap {
    /** @var Node[] */
    private $hashMap;

    public function __construct()
    {
        $this->hashMap = [];
    }

    /**
     * @param int $x
     * @param int $y
     * @param Node $node
     */
    public function add($x, $y, Node $node)
    {
        $this->hashMap[$this->computeKey($x, $y)] = $node;
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return Node
     * @throws Exception
     */
    public function get($x, $y)
    {
        $key = $this->computeKey($x, $y);
        if (array_key_exists($key, $this->hashMap)) {
            return $this->hashMap[$key];
        }

        throw new Exception();
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return string
     */
    private function computeKey($x, $y)
    {
        return sprintf("%d-%d", $x, $y);
    }
}

class Node {
    /** @var string */
    private $value;

    /** @var bool */
    private $visited;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
        $this->visited = false;
    }

    public function setVisited()
    {
        $this->visited = true;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isVisited()
    {
        return $this->visited;
    }
}
