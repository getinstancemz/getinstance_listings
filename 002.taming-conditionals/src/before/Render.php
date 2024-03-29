<?php

namespace gi\lazy\conditionals\before;

use gi\lazy\conditionals\common\Room;

class Render
{

/* listing 002.17 */
    public function renderRoom(Room $room): string
    {
        if ($room->isFlooded()) {
            // apply watery stuff
            $ret = "The room is under water";
        } else {
/* listing 002.19 */
            if ($room->isTooDark()) {
                // apply dark
                $ret = "The room is too dark to see";
            } elseif ($room->isEnchanted()) {
                // apply magic
                $ret = "The room is a glittering vortex of illusion";
            } else {
                $ret = $room->getDescription();
            }
/* /listing 002.19 */
        }
        return $ret;
    }
/* /listing 002.17 */
}
