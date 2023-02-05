<?php

/* listing 009.04 */
namespace getinstance\utils\storyai\storymodel;

class PlotPoint {
    private string $point;
    protected ?PlotPoint $parent;
    private array $children = [];

    public function __construct(string $point, PlotPoint $parent = null) {
        $this->point = $point;
        $this->parent = $parent;
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

/* /listing 009.04 */
/* listing 009.05 */
    public function accept(PlotPointVisitor $visitor): void {
        $visitor->visit($this);
    }
/* /listing 009.05 */

/* listing 009.08 */
    public function storySoFar(): array {
        $points = [];
        $node = $this;
        while (! is_null($node)) {
            $points[] = $node->getPoint();
            $node = $node->getParent();
        }
        return array_reverse($points);
    }
/* /listing 009.08 */
/* listing 009.04 */
}
 
