@extends('layouts.app')
@section('title', __('lang_v1.purchase_payment_report'))
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
    <h1>{{ __('lang_v1.purchase_payment_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
           @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => '#', 'method' => 'get', 'id' => 'purchase_payment_report_form' ]) !!}
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('supplier_id', __('purchase.supplier') . ':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location').':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::label('ppr_date_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'ppr_date_filter', 'readonly']); !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
                <div class="table-responsive">
                    <form class="d-none" id="form-print" method="post" action="{{url('/print-reports')}}">
                        @csrf
                        <textarea name="keys" id="keys"></textarea>
                        <textarea name="data" id="data"></textarea>
                        <textarea name="table_footer" id="table-footer"></textarea>
                        <input name="location_id" id="location-id">
                        <input name="print_title" id="print-title" value="">
                        <button type="submit">print</button>
                    </form>
                    <table class="table table-bordered table-striped" 
                    id="purchase_payment_report_table">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('lang_v1.paid_on')</th>
                                <th>@lang('sale.amount')</th>
                                <th>@lang('purchase.supplier')</th>
                                <th>@lang('lang_v1.payment_method')</th>
                                <th>@lang('lang_v1.purchase')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="3"><strong>@lang('sale.total'):</strong></td>
                                <td><span class="display_currency" id="footer_total_amount" data-currency_symbol ="true"></span></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    <script>
        document.addEventListener('readystatechange', event => {
            document.getElementsByClassName('dt-buttons')[0].innerHTML += '<button onclick="print()"  id="print" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
        });

        function print(){
            const keys = [
                {key: 'payment_ref_no', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 1},
                {key: 'paid_on', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 2},
                {key: 'amount', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 3},
                {key: 'supplier', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 4},
                {key: 'method', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                // {key: 'purchase', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},

            ]
            purchase_payment_report.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = purchase_payment_report.data().toArray()
            const tableFooter = document.querySelector('#purchase_payment_report_table tfoot').outerHTML.toString();
            const locationId = $('#location_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'تقرير المشتريات'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }

    </script>
@endsection