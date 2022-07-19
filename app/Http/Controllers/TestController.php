<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeneratePdfPurchasingReport;
use App\Business;
use App\BusinessLocation;

class TestController extends Controller
{
    public function test(Request $request){
       $keys = json_decode($request->keys);
       $data = json_decode($request->data);
       $tableFooter = $request->table_footer;
       $tableTitle = $request->table_title;

      $business_id = session()->get('user.business_id');

      $businessData = Business::query()->find($business_id);

        if ($request->location_id){
            $businessLocation = BusinessLocation::query()->find($request->location_id);
        }else{
            $businessLocation = $businessData->location;
        }


      $businessData = [
          'logo' => $businessData->logo,
          'name' => $businessData->name,
          'printTitle' => $request->print_title
      ];

      $location = $businessLocation->country.' ,'.$businessLocation->state.' ,'.$businessLocation->landmark;
      $emailLocation = $businessLocation->email;
      $websiteLocation = $businessLocation->website;

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

//    <p style='padding: 2px 10px;text-align: center;font-weight: bold'>KSA , Riydh , Narjas Abo bakir seddiq street</p>

        $htmlFooter =
            "<div>
                 {PAGENO} من {nb}
                 <hr/>
                <p style='padding: 2px 10px;text-align: center;font-weight: bold'>$location</p>
                <p style='padding: 2px 10px;text-align: center;font-weight: bold'>$websiteLocation $emailLocation</p>
                <br/>
                <br/>
             </div>";


      $pdfFile = new GeneratePdfPurchasingReport($keys, $data, $businessData, $htmlFooter ,$tableFooter, $tableTitle);
      return $pdfFile->generatePdf();
    }
}
