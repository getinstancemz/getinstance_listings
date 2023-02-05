<?php

namespace getinstance\utils\storyai\persist;
use getinstance\utils\storyai\storymodel\PlotPoint;

class PlotPointMapper {

    public function __construct(private Saver $saver) {
    }

    public function save(PlotPoint $root): string
    {
        $json = $this->export($root);
        $this->saver->save("nodes", $json);
        return $json;
    }

    public function export(PlotPoint $root): string
    {
        return json_encode($this->buildArray($root));
    }

    public function load(): PlotPoint 
    {
        $json = $this->saver->load("nodes");
        return $this->import($json);
    }

    public function import(string $data): PlotPoint 
    {
        $array = json_decode($data, true);
        return $this->buildTree($array);
    }
    
    //...

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
}

