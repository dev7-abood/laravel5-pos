<div class="table-responsive">
    <table class="table table-bordered table-striped table-text-center" id="profit_by_categories_table">
        <thead>
            <tr>
                <th>@lang('product.category')</th>
                <th>@lang('lang_v1.gross_profit')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong>@lang('sale.total'):</strong></td>
                <td><span class="display_currency footer_total" data-currency_symbol ="true"></span></td>
            </tr>
        </tfoot>
    </table>

    <p class="text-muted">
        @lang('lang_v1.profit_note')
    </p>
</div>
@push('script')
    <script>
        $(document).ready(function (){
            document.querySelector('#profit_by_products .btn-group').innerHTML += '<button onclick="profit_by_products()"  class="btn btn-default buttons-collection buttons-colvis btn-sm" type="button"><span><i class="fa fa-print" aria-hidden="true"></i> طباعة</span></button>';
        })
    </script>
@endpush