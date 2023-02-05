<?php

/* listing 009.06 */

namespace getinstance\utils\storyai\storymodel;

interface PlotPointVisitor {
    public function visit(PlotPoint $plotpoint);
}
