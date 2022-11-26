<?php

namespace gi\lazy\conditionals\after;

use gi\lazy\conditionals\common\ShortCircuitBase;

class ShortCircuit extends ShortCircuitBase {

    /* listing 002.03 */
    public function renderRoom(string $name): string
    {
        $room = $this->getRoom($name);
        if (! $room) {
            return $this->roomError($name);
        }

        // do
        //
        // lots
        //
        // and
        //
        // lots
        // 
        // of
        // 
        // stuff
        //

        return $this->doRender($room);
    }
    /* /listing 002.03 */
}
