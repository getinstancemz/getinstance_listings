<?php

/* listing 009.25 */
namespace getinstance\utils\storyai\persist;
use getinstance\utils\storyai\storymodel\Story;
use getinstance\utils\storyai\storymodel\PlotPoint;

class StoryMapper {

    public function __construct(private Saver $saver, private PlotPointMapper $ppmapper) {
    }

    public function save(Story $story): string
    {
        $json = $this->export($story);
        $this->saver->save("story", $json);
        $this->ppmapper->save($story->getPremise());
        return $json;
    }

    public function export(Story $story): string
    {
        $save = [];
        $save['genre'] = $story->getGenre();
        $save['currentnode'] = $story->getCurrentNode()->id;
        return json_encode($save);
    }

    public function load(): Story
    {
        $json = $this->saver->load("story");
        $premise = $this->ppmapper->load();
        return $this->import($json, $plotpoint);
    }

    public function import(string $data, PlotPoint $premise): Story
    {
        $array = json_decode($data, true);
        $story = new Story($array['genre'], $premise);
        $story->setCurrentNode($array['currentnode']);
        return $story;
    }

}

