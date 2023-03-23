<?php

namespace gi\lazy\conditionals\after;

use gi\lazy\conditionals\common\Account;
use gi\lazy\conditionals\common\Offer;

/* listing 002.09 */
abstract class UserBilling
{

    public function __construct(protected Account $account)
    {
    }

    abstract public function accountInfo(): string;
    abstract public function applyOffer(Offer $offer): float;

    // ...

/* /listing 002.09 */
    public function sendReport(string $report): string
    {
        return $report;
    }
/* listing 002.09 */
}
