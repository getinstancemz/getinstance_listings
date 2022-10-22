<?php

namespace gi\lazy\conditionals\after;

use gi\lazy\conditionals\common\Account;
use gi\lazy\conditionals\common\Offer;

class WorldUserBilling extends UserBilling {

    public function __construct(Account $account) {
        if ($account->isEu()) {
            throw new \Exception("non-EU accounts only");
        }
        parent::__construct($account);
    }

    public function accountInfo(): string
    {
        $report = "";
        $report .= $this->account->formatExpiry("Y-m-d");

        // do some EU related stuff

        return $this->sendReport($report);
    }

    public function applyOffer(Offer $offer): float
    {
        $charge = $this->account->getCharge();

        // apply the offer in an EU way
        $charge -= 1;

        return $charge;
    }
}

