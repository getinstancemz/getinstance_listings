<?php
namespace getinstance\utils\storyai\storymodel;

/* listing 009.22 */
class Story
{
    private PlotPoint $premise;
    private PlotPoint $currentnode;

    public function __construct(public string $genre, string|PlotPoint $premise) {
        if (is_string($premise)) {
            $this->premise = new PlotPoint(null, $premise);
        } else {
            $this->premise = $premise;
        }
        $parentcheck = $this->premise->getParent();
        if (! is_null($parentcheck)) {
            throw new \Exception("root node cannot have a parent");
        }
        $this->currentnode = $this->premise;
    }

    // ...
/* /listing 009.22 */

    public function constructQuery() {
        $str = "This is a {$this->genre} story.\n\n";
        $str .= "{$this->premise}.\n\n";
        $str .= "Provide three alternative plot points, each one describing a single ";
        $str .= "different event that follows immediately after this setup.\n\nFor example:\n\n";
        $str .= "1) Harry and Mark find the rabbit hiding in the pantry and resolve to eat it.\n";
        $str .= "2) The rabbit is a robot controlled by an evil agency and it attempts to kill Harry and Mark with its laser eyes.\n";
        $str .= "3) Harry and Mark find the rabbit asleep on the couch and resolve to adopt it.\n";
        return $str; 
    }

/* listing 009.25 */
    public function setCurrentNode(string $id) {
        $node = $this->findNode($id);
        if (is_null($node)) {
            throw new \Exception("Could not find node with id `$id` in this story");
        }
        $this->currentnode = $node;
        return $node;
    }

    public function getCurrentNode(): PlotPoint 
    {
        return $this->currentnode;
    }
/* /listing 009.25 */

    public function getPremise(): PlotPoint
    {
        return $this->premise;
    }

/* listing 009.22 */
    public function findNode(string $id, ?PlotPoint $node=null): ?PlotPoint {
        if (is_null($node)) {
            $node=$this->premise;
        }
        if ($node->id == $id) {
            return $node;
        }
        foreach ($node->getChildren() as $child) {
            $node = $this->findNode($id, $child);
            if (! is_null($node)) {
                return $node;
            }
        }
        return null;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }
}
