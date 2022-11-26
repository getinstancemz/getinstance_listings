<?php

namespace gi\lazy\conditionals\before;

use gi\lazy\conditionals\common\ShortCircuitBase;

class ShortCircuit extends ShortCircuitBase {

    /* listing 002.01 */
    public function renderRoom(string $name): string
    {
        if ($room = $this->getRoom($name)) {

            // do
            //
            // lots
            //
            // and
            //
    /* listing 002.02 */
            // lots
            // 
            // of
            // 
            // stuff
            //

            return $this->doRender($room);
        } else {
            return $this->roomError($name);
        }
    /* /listing 002.02 */
    }
    /* /listing 002.01 */
   
}
