@extends('layouts.app')
@section('title', __('report.customer') . ' - ' . __('report.supplier') . ' ' . __('report.reports'))
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
    <h1>{{ __('report.customer')}} & {{ __('report.supplier')}} {{ __('report.reports')}}</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cg_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':') !!}
                        {!! Form::select('cnt_customer_group_id', $customer_group, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cnt_customer_group_id']); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('type', __( 'lang_v1.type' ) . ':') !!}
                        {!! Form::select('contact_type', $types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'contact_type']); !!}
                    </div>
                </div>

            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
                <form class="d-none" id="form-print" method="post" action="{{url('/print-reports')}}">
                    @csrf
                    <textarea name="keys" id="keys"></textarea>
                    <textarea name="data" id="data"></textarea>
                    <textarea name="table_footer" id="table-footer"></textarea>
                    <input name="location_id" id="location-id">
                    <input name="print_title" id="print-title" value="">
                    <button type="submit">print</button>
                </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="supplier_report_tbl">
                    <thead>
                        <tr>
                            <th>@lang('report.contact')</th>
                            <th>@lang('report.total_purchase')</th>
                            <th>@lang('lang_v1.total_purchase_return')</th>
                            <th>@lang('report.total_sell')</th>
                            <th>@lang('lang_v1.total_sell_return')</th>
                            <th>@lang('lang_v1.opening_balance_due')</th>
                            <th>@lang('report.total_due') &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="{{ __('messages.due_tooltip')}}" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td><strong>@lang('sale.total'):</strong></td>
                            <td><span class="display_currency" id="footer_total_purchase" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_purchase_return" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_sell" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_sell_return" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_opening_bal_due" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script>
        document.addEventListener('readystatechange', event => {
            document.getElementsByClassName('dt-buttons')[0].innerHTML += '<button onclick="print()"  id="print" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
        });

        function print(){
            const keys = [
                {key: 'name', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 1},
                {key: 'total_purchase', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 2},
                {key: 'total_purchase_return', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 3},
                {key: 'total_invoice', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 4},
                {key: 'total_sell_return', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'opening_balance_due', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'due', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},

            ]
            supplier_report_tbl.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = supplier_report_tbl.data().toArray()
            const tableFooter = document.querySelector('#supplier_report_tbl tfoot').outerHTML.toString();
            const locationId = $('#location_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'تقرير الموردين والعملاء'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }

    </script>
@endsection