<?php

namespace gi\lazy\conditionals\after;

/* listing 002.13 */
class Report
{
    private string $report = "";

    public function __construct(private Output $outputter)
    {
    }

    // ...
/* /listing 002.13 */
    public function add(string $in): void
    {
        $this->report .= $in;
    }
/* listing 002.13 */

    public function output(): void
    {
        $this->outputter->out($this->report);
    }
}
