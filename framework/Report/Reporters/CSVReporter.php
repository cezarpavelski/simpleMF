<?php

namespace Framework\Report\Reporters;

use Framework\Report\IReporter;

class CSVReporter implements IReporter
{

    private $header;
    private $lines;
    private $isFile;
    private $output;
    private $fileName;

    public function __construct(array $header, array $lines, bool $isFile = false)
    {
        $this->header = $header;
        $this->lines = $lines;
        $this->isFile = $isFile;
    }

    public function generate(): string
    {
        $output = $this->getOutput();
        $this->output = fopen($output, 'w');
        $this->setHeader();
        $this->setLines();
        fclose($this->output);
        return ($this->isFile) ? $this->fileName : '';
    }

    private function getOutput(): string
    {
        $this->fileName = 'file'.strtotime('now').'.csv';
        return ($this->isFile) ? __DIR__.'/../../../storage/reports/'.$this->fileName: 'php://output';
    }

    private function setHeader(): void
    {
        fputcsv($this->output, $this->header);
    }

    private function setLines(): void
    {
        foreach ($this->lines as $line) {
            fputcsv($this->output, $line);
        }
    }

}
