<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class GeneratePdfPurchasingReport
{

    public function config()
    {
        return [
            'setAutoBottomMargin' => 'stretch',
            'shrink_tables_to_fit' => 1,
            'mode' => '',
            'format' => 'A4',
            'default_font_size' => '12',
            'default_font' => 'sans-serif',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'P',
            'title' => 'Laravel mPDF',
            'subject' => '',
            'author' => '',
            'watermark' => '',
            'show_watermark' => false,
            'show_watermark_image' => false,
            'watermark_font' => 'sans-serif',
            'display_mode' => 'fullpage',
            'watermark_text_alpha' => 0.1,
            'watermark_image_path' => '',
            'watermark_image_alpha' => 0.2,
            'watermark_image_size' => 'D',
            'watermark_image_position' => 'P',
            'custom_font_dir' => '',
            'custom_font_data' => [],
            'auto_language_detection' => false,
            'temp_dir' => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
            'pdfa' => false,
            'pdfaauto' => false,
            'use_active_forms' => false,
            'arabic-font' => [
                'R' => 'arabic-font.ttf',    // regular font
                'B' => 'arabic-font.ttf',          // optional: bold font
                'I' => 'arabic-font-Light.ttf',    // optional: italic font
                'BI' => 'arabic-font.ttf',           // optional: bold-italic font
                'useOTL' => 0xFF,
                'useKashida' => 75,
            ]
        ];
    }

    public $keys = [];
    public $data = [];
    public $currency = '';
    public $tableFooter = '';
    public $tableTitle = '';
    public $htmlFooter = '';
    public $businessData = [];

    public function __construct($keys, $data, $businessData, $htmlFooter, $tableFooter = null, $tableTitle = null)
    {
        $this->keys = $keys;
        $this->data = $data;
        $this->tableFooter = $tableFooter;
        $this->tableTitle = $tableTitle;
        $this->businessData = $businessData;
        $this->htmlFooter = $htmlFooter;


        $this->currency = session("currency")["code"];
    }

    public function htmlFooter()
    {
        return $this->htmlFooter ?? '';
    }

    public function generatePdf()
    {
        $mpdf = new \Mpdf\Mpdf($this->config());
        $mpdf->SetHTMLFooter($this->htmlFooter());
        $mpdf->WriteHTML(view('report.pdf.generate-pdf-purchasing-report', [
            'keys' => $this->keys,
            'data' => $this->data,
            'tableFooter' => $this->tableFooter,
            'currency' => $this->currency == 'SAR' ? 'ريال' : session("currency")["symbol"],
            'tableTitle' => $this->tableTitle,
            'businessData' => $this->businessData
        ]));
        return $mpdf->Output();
    }
}