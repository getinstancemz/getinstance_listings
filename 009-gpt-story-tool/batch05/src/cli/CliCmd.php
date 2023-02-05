<?php

/* listing 009.27 */
namespace getinstance\utils\storyai\cli;
use getinstance\utils\storyai\control\Runner;
use getinstance\utils\storyai\storymodel\Story;

abstract class CliCmd
{
    public abstract function run(array $args): bool;

    public function getRunner(): Runner
    {
        return new Runner();
    }

    public function statusMsg(Story $story, string $msg="") {
        if (! empty($msg)) {
            $msg = "$msg\n\n";
        }
        $plotpoint = $story->getCurrentNode();
        $parents = $plotpoint->getCurrentAndParents();
        
        $msg .= (count($parents)>3)?"[...]":"";
        $msg .= "\n";
        //print_r($parents);
        $statuslist = array_slice($parents, -3);
        //print_r($statuslist);
        //$statuslist = $parents;
        foreach ($statuslist as $item) {
            $children = $item->getChildren();
            $count = "[".count($children)."]";
            if ($plotpoint->id == $item->id) {
                $buf = "* ";
            } else {
                $buf = "  ";
            }
            $msg .= $buf . $item->id." {$count} {$item}\n"; 
        }
        $msg .= "\n";
        $children = $plotpoint->getChildren();
        if (! count($children)) {
            $msg .="     [no suggestions yet]\n";
        } else {
            foreach ($children as $child) {
                $children = $child->getChildren();
                $count = "[".count($children)."]";
                $msg .= "    <{$child->id}> $count {$child}\n"; 
            }
        }
        $msg .= "\n";
        print $msg;
    }
}
