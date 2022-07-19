@extends('layouts.app')
@section('title', __('lang_v1.product_purchase_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('lang_v1.product_purchase_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
          {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'product_purchase_report_form' ]) !!}
            <div class="col-md-3">
                <div class="form-group">
                {!! Form::label('search_product', __('lang_v1.search_product') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="hidden" value="" id="variation_id">
                        {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            <div class="col-md-3">
                <div class="form-group">

                    {!! Form::label('product_pr_date_filter', __('report.date_range') . ':') !!}
                    {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'product_pr_date_filter', 'readonly']); !!}
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
            <form id="form-print" method="post" action="{{url('/test')}}">
                @csrf
                <textarea name="keys" id="keys"></textarea>
                <textarea name="data" id="data"></textarea>
                <textarea name="table_footer" id="table-footer"></textarea>
                <input name="location_id" id="location-id">
                <input name="print_title" id="print-title" value="تقرير المشتريات">
                <button type="submit">print</button>
            </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" 
                    id="product_purchase_report_table">
                        <thead>
                            <tr>
                                <th>@lang('sale.product')</th>
                                <th>@lang('product.sku')</th>
                                <th>@lang('purchase.supplier')</th>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('sale.qty')</th>
                                <th>@lang('lang_v1.total_unit_adjusted')</th>
                                <th>@lang('lang_v1.unit_perchase_price')</th>
                                <th>@lang('sale.subtotal')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                <td id="footer_total_purchase"></td>
                                <td id="footer_total_adjusted"></td>
                                <td></td>
                                <td><span class="display_currency" id="footer_subtotal" data-currency_symbol ="true"></span></td>
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
    <script>
        document.getElementById('print').addEventListener('click', _ => {
            const keys = [
                {key: 'product_name', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'sub_sku', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'supplier', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'ref_no', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'transaction_date', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'purchase_qty', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : true},
                {key: 'quantity_adjusted', value: '', isTotalValue : true, isHtmlValue : false, isCurrency : false, isCount : true},
                {key: 'unit_purchase_price', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : true},
                {key: 'subtotal', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : true},

            ]
            product_purchase_report.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            // function isHTML(str) {
            //     const doc = new DOMParser().parseFromString(str, "text/html");
            //     return Array.from(doc.body.childNodes).some(node => node.nodeType === 1);
            // }
            const data = product_purchase_report.data().toArray()
            const tableFooter = document.querySelector('#product_purchase_report_table tfoot').outerHTML.toString();
            const locationId = $('#location_id option:selected').val()

            console.log(data)
            console.log(keys)
            // console.log(tableFooter)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId

        })
    </script>

@endsection