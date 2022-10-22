<?php

namespace gi\lazy\conditionals\before;


class Report {

    public const TO_STDOUT=1;
    public const TO_FILE=2;
    private $report = "";
    
    public function __construct(private ?string $path=null) {
        /*
        if (! in_array($this->output, [self::TO_STDOUT, self::TO_FILE])) {
            throw new \Exception("Unknown ouput rule: {$this->output})");
        }
        */

        $this->report = "pants";
    }


    public function output() {
        if (is_null($this->path)) {
            print $this->report;
        } else {
            file_put_contents($this->path, $this->report);
        }
    }
}
