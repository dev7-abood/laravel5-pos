@extends('layouts.app')
@section('title', __('account.Cost center'))

@section('css')
    <style>
    .btn-group {
        text-align: center;
        display: flex;
        justify-content: center;
    }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('account.Cost center')
            <small>@lang('account.manage_your_account')</small>
        </h1>
    </section>
    <section class="content">
        @if(!empty($not_linked_payments))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        <ul>
                            @if(!empty($not_linked_payments))
                                <li>{!! __('account.payments_not_linked_with_account', ['payments' => $not_linked_payments]) !!} <a href="{{action('AccountReportsController@paymentAccountReport')}}">@lang('account.view_details')</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @can('account.access')
            <div class="row">
                <div class="col-sm-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#other_accounts" data-toggle="tab">
                                    <i class="fa fa-book"></i> <strong>{{__('account.Cost center')}}</strong>
                                </a>
                            </li>
                            <li class="">
                                <a href="#costs-centers-delete" data-toggle="tab">
                                    <i class="fa fa-book"></i> <strong>{{__('account.Deleted cost centers')}}</strong>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="other_accounts">
                                <div class="row">
                                    <div class="col-md-12">
                                        @component('components.widget')
                                            <div class="col-md-4">
                                            </div>
                                            <div class="col-md-8">
                                                <button type="button" class="btn btn-primary btn-modal pull-right"
                                                        data-container=".account_model"
                                                        data-href="{{action('CostCenterController@create')}}">
                                                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                                            </div>
                                        @endcomponent
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="table-responsive w-100">
                                            <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="datatable">
                                                <thead>
                                                <tr>
{{--                                                    <th>@lang( 'lang_v1.Center name' )</th>--}}
                                                    <th>@lang( 'lang_v1.Arabic name' )</th>
                                                    <th>@lang( 'lang_v1.English name' )</th>
                                                    <th>@lang( 'lang_v1.Parent name' )</th>
                                                    <th>@lang( 'lang_v1.Actions' )</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="costs-centers-delete">
                                <div class="container">
                                    <br>
                                    <div class="table-responsive w-100">
                                        <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="softDelete">
                                            <thead>
                                            <tr>
{{--                                                <th>@lang( 'lang_v1.Center name' )</th>--}}
                                                <th>@lang( 'lang_v1.Arabic name' )</th>
                                                <th>@lang( 'lang_v1.English name' )</th>
                                                <th>@lang( 'lang_v1.Parent name' )</th>
                                                <th>@lang( 'lang_v1.Actions' )</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        <div class="modal fade account_model" tabindex="-1" role="dialog"
             aria-labelledby="gridSystemModalLabel">
        </div>

        <div class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="gridSystemModalLabel" id="account_type_modal">
        </div>
    </section>
@endsection

@section('javascript')

    <script>
        let datatable = $('#datatable').DataTable({
            processing : true,
            autoWidth : false,
            serverSide : true,
            ajax: '{{route('cost_center.datatable')}}',
            @if(app()->getLocale() == 'ar')
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/ar.json'
            },
            @endif
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    charset: 'UTF-8',
                    text: '<i class="fa fa-file-excel" aria-hidden="true"></i>  {{__('account.Export to Excel')}}</span>',
                    bom: true,
                    columnDefs: [ {
                        targets: -1,
                        visible: false
                    }]
                },
                {
                    extend: 'print',
                    text : '<span><i class="fa fa-print" aria-hidden="true"></i> {{__('account.Print')}}</span>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    text : '<span><i class="fa fa-columns" aria-hidden="true"></i> {{__('account.Export to Excel')}}</span>',
                    extend : 'colvis'
                },
                {
                    extend: 'csv',
                    charset: 'UTF-8',
                    text: '<i class="fa fa-file-csv" aria-hidden="true"></i> {{__('account.Export to CSV')}}</span>',
                    bom: true,
                    columnDefs: [ {
                        targets: -1,
                        visible: false
                    }]
                }
            ],
            columns: [
                {data: 'ar_name', name: 'ar_name'},
                {data: 'en_name', name: 'en_name'},
                {data: 'p_name', name: 'p_name'},
                {data: 'actions', name: 'actions', searchable: false},
            ]
        });
    </script>
    <script>
        let softDelete = $('#softDelete').DataTable({
            processing : true,
            autoWidth : false,
            serverSide : true,
            ajax: '{{route('cost_center.softDeletedDatatable')}}',
            @if(app()->getLocale() == 'ar')
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/ar.json'
            },
            @endif
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    charset: 'UTF-8',
                    text: '<i class="fa fa-file-excel" aria-hidden="true"></i>  {{__('account.Export to Excel')}}</span>',
                    bom: true,
                    columnDefs: [ {
                        targets: -1,
                        visible: false
                    }]
                },
                {
                    extend: 'print',
                    text : '<span><i class="fa fa-print" aria-hidden="true"></i> {{__('account.Print')}}</span>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    text : '<span><i class="fa fa-columns" aria-hidden="true"></i> {{__('account.Export to Excel')}}</span>',
                    extend : 'colvis'
                },
                {
                    extend: 'csv',
                    charset: 'UTF-8',
                    text: '<i class="fa fa-file-csv" aria-hidden="true"></i> {{__('account.Export to CSV')}}</span>',
                    bom: true,
                    columnDefs: [ {
                        targets: -1,
                        visible: false
                    }]
                }
            ],
            columns: [
                // {data: 'id', name: 'users.id'},
                // {data: 'name', name: 'name'},
                {data: 'ar_name', name: 'ar_name'},
                {data: 'en_name', name: 'en_name'},
                {data: 'p_name', name: 'p_name'},
                {data: 'actions', name: 'actions', searchable: false},
                // {data: 'created_at', name: 'users.created_at'},
                // {data: 'updated_at', name: 'users.updated_at'}
            ]
        });
    </script>

    <script>
        $(document).on('submit', 'form#cost_center_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: "post",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success:function(result){
                    if(result.success == true){
                        $('div.account_model').modal('hide');
                        toastr.success(result.msg);
                        datatable.ajax.reload();
                        softDelete.ajax.reload();
                    }else{
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $(document).on('click', '#delete_button', function(){
            swal({
                title: LANG.sure,
                text: LANG.confirm_delete_user,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                datatable.ajax.reload();
                                softDelete.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });


        $(document).on('click', '#force_delete', function(){
            swal({
                title: LANG.sure,
                text: LANG.confirm_delete_user,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                datatable.ajax.reload();
                                softDelete.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });

        function restore (id) {
            $.ajax({
                type: "GET",
                url: `{{route('cost_center.restore')}}/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(result){
                    toastr.success(result.msg);
                    datatable.ajax.reload();
                    softDelete.ajax.reload();
                }
            });
        }
    </script>
@endsection