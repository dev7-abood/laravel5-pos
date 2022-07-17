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


//    public $header = (object)[
//        'cr' => '',
//        'phone_number' => '',
//        'logo' => '',
//        'en_title' => '',
//        'ar_title' => '',
//
//    ];
//
//    public $footer = (object)[
//        'en_address' => '',
//        'ar_address' => '',
//        'email' => '',
//        'web_site' => ''
//    ];

    public $table_keys = [];
    public $table_names = [];

    public function __constant($table_names)
    {
        $this->table_names = $table_names;
//        $this->table_keys = $table_keys;

//        $this->header = $header;
//        $this->footer = $footer;
    }


    public function htmlFooter()
    {
        return '<div>
                 {PAGENO} من {nb}
                 <hr/>
                <p style="padding: 2px 10px;text-align: center;font-weight: bold">المملكة العربية السعودية ، الرياض ، حي النرجس ، طريق أنس بن مالك</p>
                <p style="padding: 2px 10px;text-align: center;font-weight: bold">KSA , Riydh , Narjas Abo bakir seddiq street</p>
                <p style="padding: 2px 10px;text-align: center;font-weight: bold"><a href="https://www.sahmcloud.com">www.sahmcloud.com</a> , Email: <a style="color: #0c0c0c" href="mailto:info@sahmcloud.com">info@sahmcloud.com</a></p>
                <br/>
                <br/>
                </div>';
    }

    public function generatePdf()
    {
//        return 'https://www.google.com';
//        dd($this->table_names);
//        $mpdf = new \Mpdf\Mpdf($this->config());
//        $mpdf->SetHTMLFooter($this->htmlFooter());
//        $mpdf->WriteHTML(view('report.pdf.generate-pdf-purchasing-report', [
////            'table_keys' => $this->table_keys,
//            'table_names' => $this->table_names,
////            'header' => $this->header,
////            'footer' => $this->footer
//        ]));
//
//        Storage::disk('public')->putFile('pdf/filename.pdf', $mpdf->Output('filename.pdf'));
//       return response(['success' => true, 'file_path' => asset('filename.pdf')]);
//     return   $mpdf->Output(public_path('pdf\filename.pdf'), public_path('pdf\filename.pdf'));

    }
}