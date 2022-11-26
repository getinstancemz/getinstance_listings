<?php

namespace gi\lazy\conditionals\after;

use gi\lazy\conditionals\common\Room;

class Render {

/* listing 002.20 */
    function renderRoom(Room $room) {
/* listing 002.18 */
        if ($room->isFlooded()) {
            // apply watery stuff
            return "The room is under water"; 
        } 
/* /listing 002.18 */
        if ($room->isTooDark()) {
            // apply dark
            return "The room is too dark to see"; 
        }
        if ($room->isEnchanted()) {
            // apply magic
            return "The room is a glittering vortex of illusion"; 
        }
        // default description
        return  $room->getDescription();
    }
/* /listing 002.20 */
} 

