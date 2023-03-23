<?php

namespace gi\lazy\conditionals\after;

use gi\lazy\conditionals\common\Account;

class DuplicateClauses1
{

/* listing 002.06 */
    public function accountInfo(Account $account): string
    {
        if ($account->isEu()) {
            $report = "";

            // do some EU related stuff

            $report .= $account->formatExpiry("Y-m-d");

            // do some more EU related stuff

            return $this->sendReport($report);
        } else {
            $report = "";

            // do some rest-of-world related stuff

            $report .= $account->formatExpiry("Y-m-d");

            // do some more rest-of-world related stuff

            return $this->sendReport($report);
        }
    }
/* /listing 002.06 */

    public function sendReport(string $report): string
    {
        return $report;
    }
}
