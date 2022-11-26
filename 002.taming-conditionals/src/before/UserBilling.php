<?php

namespace gi\lazy\conditionals\before;

use gi\lazy\conditionals\common\Account;
use gi\lazy\conditionals\common\Offer;

/* listing 002.08 */
class UserBilling {
    public function __construct(private Account $account)
    {
    }

    public function accountInfo(): string
    {
        $report = "";
        $report .= $this->account->formatExpiry("Y-m-d");

        if ($this->account->isEu()) {
            // do some EU related stuff
        } else {
            // do some more rest-of-world related stuff 
        }
        
        return $this->sendReport($report);
    }

    public function applyOffer(Offer $offer): float
    {
        $charge = $this->account->getCharge();

        if ($this->account->isEu()) {
            // apply the offer in an EU way
/* /listing 002.08 */
            $charge -= 2;
/* listing 002.08 */
        } else {
            // apply the offer in a rest-of-world way
/* /listing 002.08 */
            $charge -= 1;
/* listing 002.08 */
        }
        
        return $charge;
    }
    
    // ...

/* /listing 002.08 */
    public function sendReport(string $report) {
        return $report;
    }
   
/* listing 002.08 */
}
/* /listing 002.08 */

