<?php

namespace gi\lazy\conditionals\common;

/* listing 002.05 */
class Account
{

    // ....

/* /listing 002.05 */

    private bool $iseu = false;

    public function setIsEu(bool $iseu): void
    {
        $this->iseu = $iseu;
    }

    public function getExpiry(): string
    {
        if ($this->isEu()) {
            return "2024-06-24 11:45";
        }
        return "2025-06-24 11:45";
    }

    public function isEu(): bool
    {
        return $this->iseu;
    }
    
    public function getCharge(): int
    {
        return 5;
    }

/* listing 002.05 */
    public function formatExpiry(string $format): string
    {
        $expire = $this->getExpiry();
        $expdate = new \DateTime($expire);
        $formatted = $expdate->format($format);
        return $formatted;
    }
}
/* /listing 002.05 */
