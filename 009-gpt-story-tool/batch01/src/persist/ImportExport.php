<?php

/* listing 009.09 */
namespace getinstance\utils\storyai\persist;
use getinstance\utils\storyai\storymodel\PlotPoint;

class ImportExport {
    public function export(PlotPoint $root): string
    {
        return json_encode($this->buildArray($root));
    }

    public function import(string $data): PlotPoint 
    {
        $array = json_decode($data, true);
        return $this->buildTree($array);
    }

    private function buildArray(PlotPoint $node): array {
        $array = [
            'point' => $node->getPoint(),
            'children' => []
        ];
        foreach ($node->getChildren() as $child) {
            $array['children'][] = $this->buildArray($child);
        }
        return $array;
    }

    private function buildTree(array $array, PlotPoint $parent = null): PlotPoint
    {
        $node = new PlotPoint($array['point'], $parent);
        foreach ($array['children'] as $childArray) {
            $node->addChild($this->buildTree($childArray, $node));
        }
        return $node;
    }
}

