<?php

namespace gi\lazy\conditionals\before;

/* listing 002.12 */
class Report {
    private string $report = "";
    
    public function __construct(private ?string $path=null) {
    }
    
    // ...

/* /listing 002.12 */
    public function add(string $in)
    {
        $this->report .= $in;
    }

/* listing 002.12 */

    public function output() {
        if (is_null($this->path)) {
            print $this->report;
        } else {
            file_put_contents($this->path, $this->report);
        }
    }

}
