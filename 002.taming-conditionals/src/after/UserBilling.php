<?php

namespace gi\lazy\conditionals\after;

use gi\lazy\conditionals\common\Account;
use gi\lazy\conditionals\common\Offer;

/* listing 002.09 */
abstract class UserBilling {

    public function __construct(protected Account $account)
    {
    }

    public abstract function accountInfo(): string;
    public abstract function applyOffer(Offer $offer): float;

    // ...

/* /listing 002.09 */
    public function sendReport(string $report) {
        return $report;
    }
/* listing 002.09 */
}
