<?php

namespace getinstance\utils\storyai\persist;
use getinstance\utils\storyai\storymodel\PlotPoint;

class ImportExport {
    public function export(PlotPoint $root): string
    {
        return json_encode($this->buildArray($root));
    }

    public function import($data): PlotPoint 
    {
        $array = json_decode($data, true);
        return $this->buildTree($array);
    }

/* listing 009.12 */
    public function findNode(PlotPoint $node, string $id): ?PlotPoint {
        if ($node->id == $id) {
            return $node;
        }
        foreach ($node->getChildren() as $child) {
            $node = $this->findNode($child, $id);
            if (! is_null($node)) {
                return $node;
            }
        }
        return null;
    }
/* /listing 009.12 */

/* listing 009.11 */
    private function buildArray(PlotPoint $node): array {
        $array = [
            'point' => $node->getPoint(),
            'id' => $node->id,
            'children' => []
        ];
        foreach ($node->getChildren() as $child) {
            $array['children'][] = $this->buildArray($child);
        }
        return $array;
    }

    private function buildTree(array $array, PlotPoint $parent = null): PlotPoint
    {
        $node = new PlotPoint($array['id'], $array['point'], $parent);
        foreach ($array['children'] as $childArray) {
            $node->addChild($this->buildTree($childArray, $node));
        }
        return $node;
    }
/* /listing 009.11 */
}

