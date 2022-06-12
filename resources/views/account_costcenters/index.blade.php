@extends('layouts.app')
@section('title', __('account.Cost center'))

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
                                    <i class="fa fa-book"></i> <strong>@lang('account.accounts')</strong>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="other_accounts">
                                <div class="row">
                                    <div class="col-md-12">
                                        @component('components.widget')
                                            <div class="col-md-4">
                                                {!! Form::select('account_status', ['active' => __('business.is_active'), 'closed' => __('account.closed')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'account_status']); !!}
                                            </div>
                                            <div class="col-md-8">
                                                <button type="button" class="btn btn-primary btn-modal pull-right"
                                                        data-container=".account_model"
                                                        data-href="{{action('AccountController@create')}}">
                                                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                                            </div>
                                        @endcomponent
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang( 'lang_v1.Center name' )</th>
                                                    <th>@lang( 'lang_v1.Arabic name' )</th>
                                                    <th>@lang( 'lang_v1.English name' )</th>
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
    // <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $('#datatable').DataTable({
            processing : true,
            serverSide : true,
            ajax: '{{route('cost_center.datatable')}}',
            columns: [
                // {data: 'id', name: 'users.id'},
                {data: 'name', name: 'name'},
                {data: 'ar_name', name: 'ar_name'},
                {data: 'en_name', name: 'en_name', searchable: false},
                {data: 'en_name', name: 'en_name', searchable: false},
                // {data: 'created_at', name: 'users.created_at'},
                // {data: 'updated_at', name: 'users.updated_at'}
            ]
        });
    </script>
@endsection