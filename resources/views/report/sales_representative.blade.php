@extends('layouts.app')
@section('title', __('report.sales_representative'))
@section('css')
    <style>
        .buttons-print {
            display: none;
        }
    </style>
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.sales_representative')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'sales_representative_filter_form' ]) !!}
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('sr_id',  __('report.user') . ':') !!}
                        {!! Form::select('sr_id', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_users')]); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('sr_business_id',  __('business.business_location') . ':') !!}
                        {!! Form::select('sr_business_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">

                        {!! Form::label('sr_date_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sr_date_filter', 'readonly']); !!}
                    </div>
                </div>

                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
    <form class="d-none" id="form-print" method="post" action="{{url('/print-reports')}}">
        @csrf
        <textarea name="keys" id="keys"></textarea>
        <textarea name="data" id="data"></textarea>
        <textarea name="table_footer" id="table-footer"></textarea>
        <input name="location_id" id="location-id">
        <input name="print_title" id="print-title" value="">
        <button type="submit">print</button>
    </form>
    <!-- Summary -->
    <div class="row">
        <div class="col-sm-12">
            @component('components.widget', ['title' => __('report.summary')])
                <h3 class="text-muted">
                    {{ __('report.total_sell') }} - {{ __('lang_v1.total_sales_return') }}: 
                    <span id="sr_total_sales">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                    -
                    <span id="sr_total_sales_return">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                    =
                    <span id="sr_total_sales_final">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
                <div class="hide" id="total_payment_with_commsn_div">
                    <h3 class="text-muted">
                        {{ __('lang_v1.total_payment_with_commsn') }}: 
                        <span id="total_payment_with_commsn">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                    </h3>
                </div>
                <div class="hide" id="total_commission_div">
                    <h3 class="text-muted">
                        {{ __('lang_v1.total_sale_commission') }}: 
                        <span id="sr_total_commission">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                    </h3>
                </div>
                <h3 class="text-muted">
                    {{ __('report.total_expense') }}: 
                    <span id="sr_total_expenses">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#sr_sales_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> @lang('lang_v1.sales_added')</a>
                    </li>

                    <li>
                        <a href="#sr_commission_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> @lang('lang_v1.sales_with_commission')</a>
                    </li>

                    <li>
                        <a href="#sr_expenses_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> @lang('expense.expenses')</a>
                    </li>

                    @if(!empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] == 'payment_received')
                        <li>
                            <a href="#sr_payments_with_cmmsn_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> @lang('lang_v1.payments_with_cmmsn')</a>
                        </li>
                    @endif
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="sr_sales_tab">
                        @include('report.partials.sales_representative_sales')
                    </div>

                    <div class="tab-pane" id="sr_commission_tab">
                        <button onclick="sales_representative_commission()"  id="print" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>
                        @include('report.partials.sales_representative_commission')
                    </div>

                    <div class="tab-pane" id="sr_expenses_tab">
                        <button onclick="sales_representative_expenses()"  id="print" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>

                        @include('report.partials.sales_representative_expenses')
                    </div>

                    @if(!empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] == 'payment_received')
                        <div class="tab-pane" id="sr_payments_with_cmmsn_tab">
                            @include('report.partials.sales_representative_payments_with_cmmsn')
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>

    <script>
        document.addEventListener('readystatechange', event => {
            document.getElementsByClassName('dt-buttons')[0].innerHTML += '<button onclick="sr_sales_report_print()"  id="print" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
        });

        function sr_sales_report_print(){
            const keys = [
                {key: 'transaction_date', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'invoice_no', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'name', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'business_location', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'payment_status', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'final_total', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : true},
                {key: 'total_paid', value: '', isTotalValue : true, isHtmlValue : false, isCurrency : false, isCount : true},
                {key: 'total_remaining', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : true},

            ]
            sr_sales_report.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            // function isHTML(str) {
            //     const doc = new DOMParser().parseFromString(str, "text/html");
            //     return Array.from(doc.body.childNodes).some(node => node.nodeType === 1);
            // }
            const data = sr_sales_report.data().toArray()
            const tableFooter = document.querySelector('#sr_sales_report tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'المبيعات المضافة'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function sales_representative_commission(){
            const keys = [
                {key: 'transaction_date', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'invoice_no', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'name', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'business_location', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'payment_status', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'final_total', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : true},
                {key: 'total_paid', value: '', isTotalValue : true, isHtmlValue : false, isCurrency : true, isCount : true},
                {key: 'total_remaining', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : true},

            ]
            sr_sales_commission_report.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = sr_sales_commission_report.data().toArray()
            const tableFooter = document.querySelector('#sr_sales_with_commission_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'المبيعات إالى العمولة'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function sales_representative_expenses(){
            const keys = [
                {key: 'transaction_date', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'ref_no', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'category', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'location_name', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'payment_status', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'final_total', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : true},
                {key: 'expense_for', value: '', isTotalValue : true, isHtmlValue : false, isCurrency : false, isCount : true},
                {key: 'additional_notes', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : true},

            ]
            sr_expenses_report.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = sr_expenses_report.data().toArray()
            const tableFooter = document.querySelector('#sr_sales_with_commission_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'المصاريف'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }

    </script>
@endsection