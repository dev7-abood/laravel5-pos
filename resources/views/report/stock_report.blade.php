@extends('layouts.app')
@section('title', __('report.stock_report'))
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
    <h1>{{ __('report.stock_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">

    <form class="d-none" id="form-print" method="post" action="{{url('/print-reports')}}">
        @csrf
        <textarea name="keys" id="keys"></textarea>
        <textarea name="data" id="data"></textarea>
        <textarea name="table_footer" id="table-footer"></textarea>
        <input name="location_id" id="location-id">
        <input name="print_title" id="print-title" value="">
        <button type="submit">print</button>
    </form>
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('category_id', __('category.category') . ':') !!}
                        {!! Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                        {!! Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('brand', __('product.brand') . ':') !!}
                        {!! Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('unit',__('product.unit') . ':') !!}
                        {!! Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                @if($show_manufacturing_data)
                    <div class="col-md-3">
                        <div class="form-group">
                            <br>
                            <div class="checkbox">
                                <label>
                                  {!! Form::checkbox('only_mfg', 1, false, 
                                  [ 'class' => 'input-icheck', 'id' => 'only_mfg_products']); !!} {{ __('manufacturing::lang.only_mfg_products') }}
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
    @can('view_product_stock_value')
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid'])
            <table class="table no-border">
                <tr>
                    <td>@lang('report.closing_stock') (@lang('lang_v1.by_purchase_price'))</td>
                    <td>@lang('report.closing_stock') (@lang('lang_v1.by_sale_price'))</td>
                    <td>@lang('lang_v1.potential_profit')</td>
                    <td>@lang('lang_v1.profit_margin')</td>
                </tr>
                <tr>
                    <td><h3 id="closing_stock_by_pp" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="closing_stock_by_sp" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="potential_profit" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="profit_margin" class="mb-0 mt-0"></h3></td>
                </tr>
            </table>
            @endcomponent
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid'])
                @include('report.partials.stock_report_table')
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
                {key: 'sku', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 1},
                {key: 'product', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 2},
                {key: 'location_name', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 3},
                {key: 'unit_price', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 4},
                {key: 'stock', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'stock_price', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'stock_value_by_sale_price', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'potential_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'total_sold', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'total_transfered', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false, index : 5},
                {key: 'total_adjusted', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},

            ]
            stock_report_table.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = stock_report_table.data().toArray()
            const tableFooter = document.querySelector('#stock_report_table tfoot').outerHTML.toString();
            const locationId = $('#location_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'تقرير المخزون'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }

    </script>
@endsection