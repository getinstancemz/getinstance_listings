<?php

namespace getinstance\utils\storyai\storymodel;

/* listing 009.10 */
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

    // ... 

/* /listing 009.10 */
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

/* listing 009.10 */
}
 
