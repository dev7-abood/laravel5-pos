@extends('layouts.app')
@section('title', __('report.register_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.register_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'register_report_filter_form' ]) !!}
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('register_user_id',  __('report.user') . ':') !!}
                        {!! Form::select('register_user_id', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_users')]); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('register_status',  __('sale.status') . ':') !!}
                        {!! Form::select('register_status', ['open' => __('cash_register.open'), 'close' => __('cash_register.close')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all')]); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('register_report_date_range', __('report.date_range') . ':') !!}
                        {!! Form::text('register_report_date_range', null , ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'register_report_date_range', 'readonly']); !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
                <div class="d-flex justify-content-start">
                    <button id="print" class="btn btn-primary" type="button">Print</button>
                </div>
                <table class="table table-bordered table-striped" id="register_report_table">
                    <thead>
                        <tr>
                            <th>@lang('report.open_time')</th>
                            <th>@lang('report.close_time')</th>
                            <th>@lang('sale.location')</th>
                            <th>@lang('report.user')</th>
                            <th>@lang('cash_register.total_card_slips')</th>
                            <th>@lang('cash_register.total_cheques')</th>
                            <th>@lang('cash_register.total_cash')</th>
                            <th>@lang('lang_v1.total_bank_transfer')</th>
                            <th>@lang('lang_v1.total_advance_payment')</th>
                            <th>{{$payment_types['custom_pay_1']}}</th>
                            <th>{{$payment_types['custom_pay_2']}}</th>
                            <th>{{$payment_types['custom_pay_3']}}</th>
                            <th>{{$payment_types['custom_pay_4']}}</th>
                            <th>{{$payment_types['custom_pay_5']}}</th>
                            <th>{{$payment_types['custom_pay_6']}}</th>
                            <th>{{$payment_types['custom_pay_7']}}</th>
                            <th>@lang('cash_register.other_payments')</th>
                            <th>@lang('sale.total')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 text-center footer-total">
                            <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                            <td class="footer_total_card_payment"></td>
                            <td class="footer_total_cheque_payment"></td>
                            <td class="footer_total_cash_payment"></td>
                            <td class="footer_total_bank_transfer_payment"></td>
                            <td class="footer_total_advance_payment"></td>'
                            <td class="footer_total_custom_pay_1"></td>
                            <td class="footer_total_custom_pay_2"></td>
                            <td class="footer_total_custom_pay_3"></td>
                            <td class="footer_total_custom_pay_4"></td>
                            <td class="footer_total_custom_pay_5"></td>
                            <td class="footer_total_custom_pay_6"></td>
                            <td class="footer_total_custom_pay_7"></td>
                            <td class="footer_total_other_payments"></td>
                            <td class="footer_total"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascrip')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script>
        document.getElementById('print').addEventListener('click', _ => {
            const keys = [
                {key: 'created_at', value: '', isTotalValue : true, isHtmlValue : false},
                {key: 'closed_at', value: '', isTotalValue : true, isHtmlValue : false},
                {key: 'location_name', value: '', isTotalValue : true, isHtmlValue : false},
                {key: 'user_name', value: '', isTotalValue : true, isHtmlValue : false},
                {key: 'total_card_payment', value: '', isTotalValue : true, isHtmlValue : true},
                {key: 'total_cheque_payment', value: '', isTotalValue : true, isHtmlValue : true},
                {key: 'total_cash_payment', value: '', isTotalValue : true, isHtmlValue : true},
                {key: 'total_bank_transfer_payment', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_advance_payment', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_custom_pay_1', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_custom_pay_2', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_custom_pay_3', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_custom_pay_4', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_custom_pay_5', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_custom_pay_6', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_custom_pay_7', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total_other_payment', value: '', isTotalValue : true , isHtmlValue : true},
                {key: 'total', value: '', isTotalValue : true, isHtmlValue : true},
            ]
            register_report_table.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            // let data = []

            function isHTML(str) {
                const doc = new DOMParser().parseFromString(str, "text/html");
                return Array.from(doc.body.childNodes).some(node => node.nodeType === 1);
            }

            const data = register_report_table.data().toArray()

            // register_report_table.data().map((d, index) => {
            //     try {
            //         const innerData = []
            //         keys.map((keyItem, keyIndex) => {
            //             let value = d[keys[keyIndex].key]
            //             const key = keys[keyIndex].key
            //             innerData.push({
            //                 key,
            //                 value
            //             })
            //         })
            //         data = innerData
            //     }catch (err){}
            // }).toArray()

            console.log(data)
            console.log(keys)

            $.ajax({
                url: '{{url('/test')}}',
                dataType: "json",
                type: "Post",
                async: true,
                data: { keys, data },
                success: function (data) {
                    console.log(data)
                },
            });


        })
    </script>
@endsection