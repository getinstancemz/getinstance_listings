<?php
/* listing 009.17 */
namespace getinstance\utils\storyai\storymodel;

class Story
{
    public function __construct(public string $genre, public string $premise) {

    }

    public function constructQuery() {
        $str = "This is a {$this->genre} story. ";
        $str .= $this->premise . ". ";
        $str .= "Provide three alternative plot points each one describing a single ";
        $str .= "different event that follows immediately after this setup.";
        return $str; 
    }
}
