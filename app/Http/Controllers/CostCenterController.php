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
        $costCenters = CostCenter::query()->select([
            'id', 'name', 'en_name', 'ar_name'
        ])->orderBy('id', 'desc')->get();

        return view('account_costcenters.create', ['costCenters' => $costCenters]);
    }

    public function store(Request $request)
    {
        $data = [
        'name' => $request->en_name,
        'ar_name' => $request->ar_name,
        'en_name' => $request->en_name,
        'parent_id' => $request->parent_id
        ];
        CostCenter::query()->create($data);
        return ['success' => true, 'msg' => __("account.Cost center created successfully")];
    }

    public function edit($id)
    {
        $costCenters = CostCenter::query()->select([
            'id', 'name', 'en_name', 'ar_name'
        ])->orderBy('id', 'desc')->get();
        $costCenter = CostCenter::withTrashed()->find($id);
        return view('account_costcenters.edit', ['costCenter' => $costCenter, 'costCenters' => $costCenters]);
    }

    public function destroy($id)
    {
       $costCenter = CostCenter::withTrashed()->find($id);
       $costCenter->delete();
        return ['success' => true, 'msg' => __("account.Cost center deleted successfully")];
    }

    public function show()
    {
        $costCenters = CostCenter::query()
            ->orderBy('id', 'desc')
            ->with('parent')
            ->get();

        return DataTables::of($costCenters)
            ->addColumn('p_name', function ($query) {
                return $query->parent->name ?? '-';
            })->addColumn('p_name', function ($query) {
                return $query->parent->name ?? '-';
            })
            ->addColumn('actions', function ($query) {
                $ac = action('CostCenterController@edit', ['id' => $query->id]);
                $destroy = action('CostCenterController@destroy', ['id' => $query->id]);
                $delete = __('account.Delete');
                $edit = __('account.Edit');
                return
                    "<div class='d-flex justify-content-center'>
                                <button type='button' class='btn btn-xs btn-primary btn-modal'
                                 data-container='.account_model'
                                 data-href='$ac'><i class='glyphicon glyphicon-edit'></i>$edit</button>
                    &nbsp;
                    <button id='delete_button' data-href='$destroy' class='btn btn-xs btn-danger delete_user_button' class='btn btn-xs btn-danger delete_user_button'><i class='glyphicon glyphicon-trash'></i> $delete</button></div>";
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function update($id ,Request $request)
    {
        $constCenter = CostCenter::withTrashed()->find($id);
        $constCenter->name = $request->en_name;
        $constCenter->ar_name = $request->ar_name;
        $constCenter->en_name = $request->en_name;
        $constCenter->parent_id = $request->parent_id;
        $constCenter->save();
        return ['success' => true, 'msg' => __("account.Cost center updated successfully")];
    }


    public function softDeletedDatatable()
    {
        $costCenter = CostCenter::onlyTrashed()->with(['parent' => function($query){
            $query->withTrashed();
        }])->orderBy('id', 'desc')->get();

        return DataTables::of($costCenter)
            ->addColumn('p_name', function ($query) {
                return $query->parent->name ?? '-';
            })->addColumn('p_name', function ($query) {
                return $query->parent->name ?? '-';
            })
            ->addColumn('actions', function ($query) {
                $id = $query->id;
                $destroy = action('CostCenterController@forceDelete', ['id' => $query->id]);
                $delete = __('account.Delete');
                $active = __('account.Active');
                return
                    "<div class='d-flex justify-content-center'>
                                <button onclick='restore($id)' id='btn-restore' type='button' class='btn btn-xs btn-success'
                                 data-id='$id'><i class='glyphicon glyphicon-arrow-up'></i>$active</button>
                    &nbsp;
                    <button id='force_delete' data-href='$destroy' class='btn btn-xs btn-danger delete_user_button' class='btn btn-xs btn-danger delete_user_button'><i class='glyphicon glyphicon-trash'></i> $delete</button></div>";
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function restore(Request $request)
    {
        $constCenter = CostCenter::withTrashed()->find($request->id);
        $constCenter->restore();
        return ['success' => true, 'msg' => __("account.Cost center updated successfully")];
    }

    public function forceDelete($id)
    {
        try {
            $constCenter = CostCenter::withTrashed()->find($id);
            $constCenter->forceDelete();
            return ['success' => true, 'msg' => __("account.Cost center deleted successfully")];
        }catch (\Illuminate\Database\QueryException $err){
            return ['success' => false, 'msg' => __("account.Delete the top account")];
        }
    }
}
