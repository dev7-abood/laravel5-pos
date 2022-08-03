@extends('layouts.app')
@section('title', __( 'report.profit_loss' ))
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
    <h1>@lang( 'report.profit_loss' )
    </h1>
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
    <div class="print_section"><h2>{{session()->get('business.name')}} - @lang( 'report.profit_loss' )</h2></div>
    
    <div class="row no-print">
        <div class="col-md-3 col-md-offset-7 col-xs-6">
            <div class="input-group">
                <span class="input-group-addon bg-light-blue"><i class="fa fa-map-marker"></i></span>
                 <select class="form-control select2" id="profit_loss_location_filter">
                    @foreach($business_locations as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-xs-6">
            <div class="form-group pull-right">
                <div class="input-group">
                  <button type="button" class="btn btn-primary" id="profit_loss_date_filter">
                    <span>
                      <i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="pl_data_div">
        </div>
    </div>
    

    <div class="row no-print">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary pull-right" 
            aria-label="Print" onclick="window.print();"
            ><i class="fa fa-print"></i> @lang( 'messages.print' )</button>
        </div>
    </div>
    <div class="row no-print">
        <div class="col-md-12">
           <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#profit_by_products"  data-toggle="tab" aria-expanded="true"><i class="fa fa-cubes" aria-hidden="true"></i> @lang('lang_v1.profit_by_products')</a>
                    </li>

                    <li>
                        <a href="#profit_by_categories" onclick="tap2()" data-toggle="tab" aria-expanded="true"><i class="fa fa-tags" aria-hidden="true"></i> @lang('lang_v1.profit_by_categories')</a>
                    </li>

                    <li>
                        <a href="#profit_by_brands" onclick="tap3()"  data-toggle="tab" aria-expanded="true"><i class="fa fa-diamond" aria-hidden="true"></i> @lang('lang_v1.profit_by_brands')</a>
                    </li>

                    <li>
                        <a href="#profit_by_locations" onclick="tap4()"  data-toggle="tab" aria-expanded="true"><i class="fa fa-map-marker" aria-hidden="true"></i> @lang('lang_v1.profit_by_locations')</a>
                    </li>

                    <li>
                        <a href="#profit_by_invoice" onclick="tap5()"  data-toggle="tab" aria-expanded="true"><i class="fa fa-file-alt" aria-hidden="true"></i> @lang('lang_v1.profit_by_invoice')</a>
                    </li>

                    <li>
                        <a href="#profit_by_date " onclick="tap6()"  data-toggle="tab" aria-expanded="true"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang_v1.profit_by_date')</a>
                    </li>
                    <li>
                        <a href="#profit_by_customer" onclick="tap7()"  data-toggle="tab" aria-expanded="true"><i class="fa fa-user" aria-hidden="true"></i> @lang('lang_v1.profit_by_customer')</a>
                    </li>
                    <li>
                        <a href="#profit_by_day" onclick="tap8()"  data-toggle="tab" aria-expanded="true"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang_v1.profit_by_day')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="profit_by_products"> 
                        @include('report.partials.profit_by_products')
                    </div>

                    <div class="tab-pane" id="profit_by_categories">
                        @include('report.partials.profit_by_categories')
                    </div>

                    <div class="tab-pane" id="profit_by_brands">
                        @include('report.partials.profit_by_brands')
                    </div>

                    <div class="tab-pane" id="profit_by_locations">
                        @include('report.partials.profit_by_locations')
                    </div>

                    <div class="tab-pane" id="profit_by_invoice">
                        @include('report.partials.profit_by_invoice')
                    </div>

                    <div class="tab-pane" id="profit_by_date">
                        @include('report.partials.profit_by_date')
                    </div>

                    <div class="tab-pane" id="profit_by_customer">
                        @include('report.partials.profit_by_customer')
                    </div>

                    <div class="tab-pane" id="profit_by_day">
                    </div>
                </div>
            </div>
        </div>
    </div>
	

</section>
<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    $(document).ready( function() {
        profit_by_products_table = $('#profit_by_products_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/reports/get-profit/product",
                    "data": function ( d ) {
                        d.start_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        d.end_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                        d.location_id = $('#profit_loss_location_filter').val();
                    }
                },
                columns: [
                    { data: 'product', name: 'product'  },
                    { data: 'gross_profit', "searchable": false},
                ],
                fnDrawCallback: function(oSettings) {
                    var total_profit = sum_table_col($('#profit_by_products_table'), 'gross-profit');
                    $('#profit_by_products_table .footer_total').text(total_profit);

                    __currency_convert_recursively($('#profit_by_products_table'));
                },
            });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr('href');
            if ( target == '#profit_by_categories') {
                if(typeof profit_by_categories_datatable == 'undefined') {
                    profit_by_categories_datatable = $('#profit_by_categories_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/category",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'category', name: 'C.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_categories_table'), 'gross-profit');
                            $('#profit_by_categories_table .footer_total').text(total_profit);

                            __currency_convert_recursively($('#profit_by_categories_table'));
                        },
                    });
                } else {
                    profit_by_categories_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_brands') {
                if(typeof profit_by_brands_datatable == 'undefined') {
                    profit_by_brands_datatable = $('#profit_by_brands_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/brand",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'brand', name: 'B.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_brands_table'), 'gross-profit');
                            $('#profit_by_brands_table .footer_total').text(total_profit);

                            __currency_convert_recursively($('#profit_by_brands_table'));
                        },
                    });
                } else {
                    profit_by_brands_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_locations') {
                if(typeof profit_by_locations_datatable == 'undefined') {
                    profit_by_locations_datatable = $('#profit_by_locations_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/location",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'location', name: 'L.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_locations_table'), 'gross-profit');
                            $('#profit_by_locations_table .footer_total').text(total_profit);

                            __currency_convert_recursively($('#profit_by_locations_table'));
                        },
                    });
                } else {
                    profit_by_locations_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_invoice') {
                if(typeof profit_by_invoice_datatable == 'undefined') {
                    profit_by_invoice_datatable = $('#profit_by_invoice_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/invoice",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'invoice_no', name: 'sale.invoice_no'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_invoice_table'), 'gross-profit');
                            $('#profit_by_invoice_table .footer_total').text(total_profit);

                            __currency_convert_recursively($('#profit_by_invoice_table'));
                        },
                    });
                } else {
                    profit_by_invoice_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_date') {
                if(typeof profit_by_date_datatable == 'undefined') {
                    profit_by_date_datatable = $('#profit_by_date_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/date",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'transaction_date', name: 'sale.transaction_date'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_date_table'), 'gross-profit');
                            $('#profit_by_date_table .footer_total').text(total_profit);
                            __currency_convert_recursively($('#profit_by_date_table'));
                        },
                    });
                } else {
                    profit_by_date_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_customer') {
                if(typeof profit_by_customers_table == 'undefined') {
                    profit_by_customers_table = $('#profit_by_customer_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/customer",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'customer', name: 'CU.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_customer_table'), 'gross-profit');
                            $('#profit_by_customer_table .footer_total').text(total_profit);
                            __currency_convert_recursively($('#profit_by_customer_table'));
                        },
                    });
                } else {
                    profit_by_customers_table.ajax.reload();
                }
            } else if (target == '#profit_by_day') {
                var start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');

                var end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                var location_id = $('#profit_loss_location_filter').val();

                var url = '/reports/get-profit/day?start_date=' + start_date + '&end_date=' + end_date + '&location_id=' + location_id;
                $.ajax({
                        url: url,
                        dataType: 'html',
                        success: function(result) {
                           $('#profit_by_day').html(result); 
                            profit_by_days_table = $('#profit_by_day_table').DataTable({
                                    "searching": false,
                                    'paging': false,
                                    'ordering': false,
                            });
                            var total_profit = sum_table_col($('#profit_by_day_table'), 'gross-profit');
                           $('#profit_by_day_table .footer_total').text(total_profit);
                            __currency_convert_recursively($('#profit_by_day_table'));
                        },
                    });
            } else if (target == '#profit_by_products') {
                profit_by_products_table.ajax.reload();
            }
        });
    });
</script>

    <script>

        $(document).ready(function (){
            document.querySelector('#profit_by_products .btn-group').innerHTML += '<button onclick="profit_by_products()"  class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>';
        })


        function profit_by_products(){
            const keys = [
                {key: 'product', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},


            ]
            profit_by_products_table.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_products_table.data().toArray()
            const tableFooter = document.querySelector('#profit_by_products_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'تقرير الربح من المنتجات'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function profit_by_categories(){
            const keys = [
                {key: 'category', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},
            ]
            profit_by_categories_datatable.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_categories_datatable.data().toArray()
            const tableFooter = document.querySelector('#profit_by_categories_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'الربح حسب الفئات'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function profit_by_brands(){
            const keys = [
                {key: 'brand', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},
            ]

            profit_by_brands_datatable.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_brands_datatable.data().toArray()
            const tableFooter = document.querySelector('#profit_by_brands_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'الربح من العلامات التجارية'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function profit_by_locations(){
            const keys = [
                {key: 'location', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},
            ]

            profit_by_locations_datatable.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_locations_datatable.data().toArray()
            const tableFooter = document.querySelector('#profit_by_locations_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'الربح حسب الفرع'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function profit_by_invoice(){
            const keys = [
                {key: 'invoice_no', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},
            ]

            profit_by_invoice_datatable.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_invoice_datatable.data().toArray()
            const tableFooter = document.querySelector('#profit_by_invoice_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'الربح عن طريق الفاتورة'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function profit_by_date(){
            const keys = [
                {key: 'transaction_date', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},
            ]


            profit_by_date_datatable.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_date_datatable.data().toArray()
            const tableFooter = document.querySelector('#profit_by_date_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'الربح حسب التاريخ'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function profit_by_customer(){
            const keys = [
                {key: 'customer', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},
            ]

            profit_by_customers_table.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_customers_table.data().toArray()
            const tableFooter = document.querySelector('#profit_by_customer_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'الربح من قبل العملاء'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }
        function profit_by_day(){
            const keys = [
                {key: 'day', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : false, isCount : false},
                {key: 'gross_profit', value: '', isTotalValue : false, isHtmlValue : false, isCurrency : true, isCount : false},
            ]

            profit_by_days_table.columns().header().map((d, index) => {
                try {
                    keys[index].value = d.textContent
                }catch (err){
                }
            }).toArray()

            const data = profit_by_days_table.data().toArray()
            const tableFooter = document.querySelector('#profit_by_day_table tfoot').outerHTML.toString();
            const locationId = $('#sr_business_id option:selected').val()

            console.log(data)
            console.log(keys)

            document.getElementById('keys').innerText = JSON.stringify(keys)
            document.getElementById('data').innerText = JSON.stringify(data)
            document.getElementById('table-footer').innerText = tableFooter
            document.getElementById('location-id').defaultValue  = locationId
            document.getElementById('print-title').defaultValue  = 'الربح بعد يوم'

            setTimeout(_ => {
                document.getElementById('form-print').submit()
            }, 1000)
        }

    </script>

    <script>
        let tap_2 = 0
        function tap2(){
            tap_2++
            if (tap_2 === 1){
                setTimeout(_ => {
                    document.querySelector('#profit_by_categories .btn-group').innerHTML += '<button onclick="profit_by_categories()" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
                }, 1000)
            }
        }

        let tap_3 = 0
        function tap3(){
            tap_3++
            if (tap_3 === 1){
                setTimeout(_ => {
                    document.querySelector('#profit_by_brands .btn-group').innerHTML += '<button onclick="profit_by_brands()" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
                }, 1000)
            }
        }

        let tap_4 = 0
        function tap4(){
            tap_4++
            if (tap_4 === 1){
                setTimeout(_ => {
                    document.querySelector('#profit_by_locations .btn-group').innerHTML += '<button onclick="profit_by_locations()" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
                }, 1000)
            }
        }

        let tap_5 = 0
        function tap5(){
            tap_5++
            if (tap_5 === 1){
                setTimeout(_ => {
                    document.querySelector('#profit_by_invoice .btn-group').innerHTML += '<button onclick="profit_by_invoice()" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
                }, 1000)
            }
        }

        let tap_6 = 0
        function tap6(){
            tap_6++
            if (tap_6 === 1){
                setTimeout(_ => {
                    document.querySelector('#profit_by_date .btn-group').innerHTML += '<button onclick="profit_by_invoice()" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
                }, 1000)
            }
        }

        // let tap_7 = 0
        // function tap7(){
        //     tap_7++
        //     if (tap_7 === 1){
        //         setTimeout(_ => {
        //             document.querySelector('#profit_by_customer .btn-group').innerHTML += '<button onclick="profit_by_invoice()" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
        //         }, 1000)
        //     }
        // }

        // let tap_8 = 0
        // function tap8(){
        //     tap_8++
        //     if (tap_8 === 1){
        //         setTimeout(_ => {
        //             document.querySelector('#profit_by_day .btn-group').innerHTML += '<button onclick="profit_by_day()" class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>'
        //         }, 1000)
        //     }
        // }


    </script>
@endsection
@stack('script')
