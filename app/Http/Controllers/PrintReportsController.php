<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeneratePdfPurchasingReport;
use App\Business;
use App\BusinessLocation;

class PrintReportsController extends Controller
{
    public function print(Request $request){
       $keys = json_decode($request->keys);
       $data = json_decode($request->data);
       $tableFooter = $request->table_footer;
       $tableTitle = $request->table_title;

//       dd($data);

      $business_id = session()->get('user.business_id');

      $businessData = Business::query()->find($business_id);
        if ($request->location_id && $request->location_id != 'undefined'){
            $businessLocation = BusinessLocation::query()->find($request->location_id);
        }else{
            $businessLocation = $businessData->location;
        }

      $businessData = [
          'logo' => $businessData->logo ?? '',
          'name' => $businessData->name ?? '',
          'printTitle' => $request->print_title ?? '',
          'mobile' => $businessLocation->mobile ?? '',
          'cr' => $businessLocation->custom_field1 ?? '',
          'en_company_name' => $businessLocation->custom_field2 ?? ''
      ];

        try {
            $location = $businessLocation->country.' ,'.$businessLocation->state.' ,'.$businessLocation->landmark;
        } catch (\ErrorException $errorException){
            $location = '';
        }

        try {
            $emailLocation = $businessLocation->email;
        }  catch (\ErrorException $errorException){
            $emailLocation = '';
        }
        try {
            $websiteLocation = $businessLocation->website;
        }catch (\ErrorException $errorException){
            $websiteLocation = '';
        }

        try {
            $custom_field4 = $businessLocation->custom_field4;
        }catch (\ErrorException $errorException){
            $custom_field4 = '';
        }

      if ($emailLocation){
          $emailLocation = " , Email: <a style='color: #0c0c0c' href='mailto:$emailLocation'>$emailLocation</a>";
      }else{
          $emailLocation = '';
      }

      if ($websiteLocation){
          $websiteLocation = "<a href='$websiteLocation'>$websiteLocation</a>";
      }else{
          $websiteLocation = '';
      }

        $htmlFooter =
            "<div>
                 {PAGENO} من {nb}
                 <hr/>
                <p style='padding: 2px 10px;text-align: center;font-weight: bold'>$location</p>
                <p style='padding: 2px 10px;text-align: center;font-weight: bold'>$custom_field4</p>
                <p style='padding: 2px 10px;text-align: center;font-weight: bold'>$websiteLocation $emailLocation</p>
                <br/>
                <br/>
             </div>";

      $pdfFile = new GeneratePdfPurchasingReport($keys, $data, $businessData, $htmlFooter ,$tableFooter, $tableTitle);
      return $pdfFile->generatePdf();
    }
}
