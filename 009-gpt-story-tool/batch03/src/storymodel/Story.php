<?php
namespace getinstance\utils\storyai\storymodel;

class Story
{
    private PlotPoint $premise;

    public function __construct(public string $genre, string $premise) {
        $this->premise = new PlotPoint(null, $premise);
    }

/* listing 009.21 */
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
/* /listing 009.21 */

    public function getPremise(): PlotPoint
    {
        return $this->premise;
    }
}
