<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CostCenter;

use Yajra\DataTables\DataTables;


class CostCenterController extends Controller
{
    public function index()
    {
        return view('account_costcenters.index');
    }

    public function create()
    {
        return view('account_costcenters.create');
    }

    public function edit()
    {
        return view('account_costcenters.edit');
    }

    public function show(){
        $costCenters = CostCenter::query()
            ->orderBy('id', 'desc')
            ->with('parent')
            ->get();

        return DataTables::of($costCenters)
            ->addColumn('p_name', function ($query) {
                return $query->parent->name ?? '-';
            })->addColumn('p_ar_name', function ($query) {
                return $query->parent->ar_name ?? '-';
            })
            ->addColumn('p_en_name', function ($query) {
                return $query->parent->en_name ?? '-';
            })
//            ->rawColumns(['status', 'fund', 'show.map'])
            ->make(true);
    }

//    public function datatable()
//    {
//        $costCenters = CostCenter::query()
//            ->orderBy('id', 'desc')
//            ->with('parent')
//            ->get();
//
//        return DataTables::of($costCenters)
//            ->addColumn('p_name', function ($query) {
//                return $query->parent->name;
//            })->addColumn('p_ar_name', function ($query) {
//                return $query->parent->ar_name;
//            })
//            ->addColumn('p_en_name', function ($query) {
//                return $query->parent->en_name;
//            })
//            ->rawColumns(['status', 'fund', 'show.map'])
//            ->make(true);
//    }

}
