<?php

namespace App\Services;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

Class GeneratePdfPurchasingReport
{
    public $header = (object) [
        'cr' => '',
        'phone_number' => '',
        'logo' => '',
        'en_title' => '',
        'ar_title' => '',

    ];

    public $footer = (object) [
        'en_address' => '',
        'ar_address' => '',
        'email' => '',
        'web_site' => ''
    ];

    public function __constant($header, $footer)
    {
        $this->header = $header;
        $this->footer = $footer;
    }

    public function generatePdf()
    {
            $data = [
                'foo' => 'bar'
            ];
            $pdf = PDF::loadView('pdf.document', $data);
            return $pdf->stream('report.pdf.generate-pdf-purchasing-report');

//        return view('report.pdf.generate-pdf-purchasing-report')->render();
    }

}