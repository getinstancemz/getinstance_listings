<?php

namespace gi\lazy\conditionals\after;

use gi\lazy\conditionals\common\Account;

class DuplicateClauses2 {

/* listing 002.07 */
    public function accountInfo(Account $account): string
    {
        $report = "";
        $report .= $account->formatExpiry("Y-m-d");

        if ($account->isEu()) {
            
            // do some EU related stuff
            // do some more EU related stuff 

        } else {

            // do some rest-of-world related stuff
            // do some more rest-of-world related stuff 

        }

        return $this->sendReport($report);
    }
/* /listing 002.07 */

    public function sendReport(string $report) {
        return $report;
    }
   
}

