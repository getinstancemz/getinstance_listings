<?php

namespace getinstance\utils\storyai\storymodel;

class PlotPoint {
    private string $point;
    protected ?PlotPoint $parent;
    private array $children = [];
    public readonly string $id;

    public function __construct(?string $id, string $point, PlotPoint $parent = null) {
        if (empty($id)) {
            $id = uniqid();
        }
        $this->id = $id;
        $this->point = $point;
        $this->parent = $parent;
    }

    static function textGenerate(string $str) {
        $ret = [];
        $array = preg_split("/^\d[\)\.]\s*/m", $str, -1, \PREG_SPLIT_NO_EMPTY);
        foreach ($array as $point) {
            $ret[] = new self(null, trim($point));
        }
        return $ret;
    }

    public function getPoint(): string {
        return $this->point;
    }

    public function setPoint(string $point): void{
        $this->point = $point;
    }

    public function getParent(): ?PlotPoint {
        return $this->parent;
    }

    public function addChild(PlotPoint $child): PlotPoint {
        $this->children[] = $child;
        $child->parent = $this;
		return $child;
    }

    public function getChildren(): array {
        return $this->children;
    }

    public function accept(PlotPointVisitor $visitor): void {
        $visitor->visit($this);
    }

    public function storySoFar(): array {
        $points = [];
        $node = $this;
        while (! is_null($node)) {
            $points[] = $node->getPoint();
            $node = $node->getParent();
        }
        return array_reverse($points);
    }

    public function __toString(): string
    {
        return $this->point;
    }
}
 
