<?php

namespace getinstance\utils\storyai\storymodel;

interface PlotPointVisitor {
    public function visit(PlotPoint $plotpoint);
}
