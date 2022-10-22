<?php

namespace gi\lazy\conditionals\before;

use gi\lazy\conditionals\common\Account;

class DuplicateClauses {

/* listing 002.04 */
    public function accountInfo(Account $account): string
    {
        if ($account->isEu()) {
            
            $report = "";

            // do some EU related stuff
 
            $expire = $account->getExpiry();
            $expdate = new \DateTime($expire);
            $formatted = $expdate->format("Y-m-d");
            $report .= $formatted;
          
            // do some more EU related stuff 

            return $this->sendReport($report);
        } else {

            $report = "";

            // do some rest-of-world related stuff

            $expire = $account->getExpiry();
            $expdate = new \DateTime($expire);
            $formatted = $expdate->format("Y-m-d");
            $report .= $formatted;

            // do some more rest-of-world related stuff 

            return $this->sendReport($report);
        }
    }
/* /listing 002.04 */

    public function sendReport(string $report) {
        return $report;
    }
   
}

