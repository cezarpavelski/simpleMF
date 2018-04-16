<?php

namespace Framework\Report\Reporters;

use Framework\Report\IReporter;
use Dompdf\Dompdf;

class PDFReporter implements IReporter
{
    private $html;
    private $fileName;

    public function __construct(string $html)
    {
        $this->html = $html;
    }

    public function generate(): string
    {
        $this->fileName = 'file'.strtotime('now').'.pdf';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        file_put_contents(__DIR__.'/../../../storage/reports/'.$this->fileName, $dompdf->output());
        return $this->fileName;
    }

}
