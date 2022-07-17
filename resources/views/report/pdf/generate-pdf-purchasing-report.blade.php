<!doctype html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style>
    body {
        font-size: 12px;
    }

    table {
        /*font-family: arial, sans-serif;*/
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .th-info, .td-info {
        text-align: center;
        background-color: white;
        border: none;
    }

    .table-none-border {
        border: none !important;
    }

</style>
<body>

<div>
    <table class="table-none-border" style="width: 100%;border: none !important;">
        <tr class="table-none-border">
            <td class="table-none-border">
                <div>
                    <p style="font-weight: bold">شركة جولدن سنت للعطور</p>
                    <p>سجل تجاري: 1</p>
                    <p>0589939393</p>
                </div>
            </td>
            <td class="table-none-border">
                Image
            </td>
            <td class="table-none-border">
                <div>
                    <p style="font-weight: bold">Comp Perfume Scent G</p>
                    <p>CR: 10101010101</p>
                    <p>0595959595</p>
                </div>
            </td>
        </tr>
    </table>
    <hr/>
    <br/>
    <table>
        <tr class="table-none-border">
            <td class="table-none-border"></td>
            <td class="table-none-border" style="background-color: #F2F2F2;padding: 15px;width: 25%">
                <div style="text-align: center;">
                    <div style="
                         font-size: 15px;
                         font-weight: bold;
            ">
                        تقرير المشتريات
                    </div>
                </div>
            </td>
            <td class="table-none-border"></td>
        </tr>
    </table>
    <br>
    <br>
    <br>


    <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 75vh;"><table class="table table-bordered table-striped dataTable" id="register_report_table" role="grid" aria-describedby="register_report_table_info" style="width: 1815px;"><thead>
            <tr role="row" style="height: 0px;"><th class="sorting_asc" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 49.9625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-sort="ascending" aria-label="وقت البداية: activate to sort column descending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">وقت البداية</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 42.9625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="وقت الانتهاء: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">وقت الانتهاء</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 33.9875px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الفرع: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الفرع</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 91.975px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="المستخدم: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">المستخدم</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 59.8px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="العدد الإجمالي للبطاقات: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">العدد الإجمالي للبطاقات</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 56.9px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="مجموع الشيكات: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">مجموع الشيكات</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 45.9375px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="مجموع النقد: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">مجموع النقد</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 62.9625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="إجمالي التحويل المصرفي: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">إجمالي التحويل المصرفي</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 52.7625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="إجمالي الدفعة المقدمة: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">إجمالي الدفعة المقدمة</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 63.8625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الدفع المخصص 1: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الدفع المخصص 1</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 63.8625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الدفع المخصص 2: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الدفع المخصص 2</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 63.8625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الدفع المخصص 3: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الدفع المخصص 3</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 63.8625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الدفع المخصص 4: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الدفع المخصص 4</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 63.8625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الدفع المخصص 5: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الدفع المخصص 5</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 63.8625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الدفع المخصص 6: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الدفع المخصص 6</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 63.8625px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="الدفع المخصص 7: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">الدفع المخصص 7</div></th><th class="sorting" aria-controls="register_report_table" rowspan="1" colspan="1" style="width: 59.8px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="مدفوعات الأخرى: activate to sort column ascending"><div class="dataTables_sizing" style="height:0;overflow:hidden;">مدفوعات الأخرى</div></th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 55.925px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="المجموع"><div class="dataTables_sizing" style="height:0;overflow:hidden;">المجموع</div></th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 56.9875px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="خيار"><div class="dataTables_sizing" style="height:0;overflow:hidden;">خيار</div></th></tr>
            </thead><tfoot>
            <tr class="bg-gray font-17 text-center footer-total" style="height: 0px;"><td colspan="4" rowspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 357.888px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;"><strong>المجموع:</strong></div></td><td class="footer_total_card_payment" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 81.8px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_cheque_payment" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 78.9px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_cash_payment" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 67.9375px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_bank_transfer_payment" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 84.9625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_advance_payment" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 74.7625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_custom_pay_1" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 85.8625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_custom_pay_2" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 85.8625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_custom_pay_3" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 85.8625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_custom_pay_4" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 85.8625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_custom_pay_5" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 85.8625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_custom_pay_6" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 85.8625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_custom_pay_7" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 85.8625px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total_other_payments" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 81.8px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td class="footer_total" rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 55.925px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;">$ 0.00</div></td><td rowspan="1" colspan="1" style="padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px; width: 56.9875px;"><div class="dataTables_sizing" style="height:0;overflow:hidden;"></div></td></tr>
            </tfoot>


            <tbody><tr role="row" class="odd"><td class="sorting_1">06/15/2022 23:49</td><td></td><td>Test</td><td>Eng Abdulrhman Herzallah<br>admin@gmail.com</td><td><span data-orig-value="0.0000">$ 0.00 (0)</span></td><td><span data-orig-value="0.0000">$ 0.00 (0)</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0.0000">$ 0.00</span></td><td><span data-orig-value="0">$ 0.00</span></td><td><button type="button" data-href="http://127.0.0.1:8000/cash-register/1" class="btn btn-xs btn-info btn-modal" data-container=".view_register"><i class="fas fa-eye" aria-hidden="true"></i> فحص</button> <button type="button" data-href="http://127.0.0.1:8000/cash-register/close-register/1" class="btn btn-xs btn-danger btn-modal" data-container=".view_register"><i class="fas fa-window-close"></i> إغلاق</button> </td></tr></tbody></table></div>

{{--    <table>--}}
{{--        <thead repeat_header="0">--}}
{{--        <tr>--}}
{{--            @foreach($table_names as $table_name)--}}
{{--                <th>{{$table_name}}</th>--}}
{{--            @endforeach--}}
{{--            <th>الرقم المرجعي</th>--}}
{{--            <th>المدفوعة على</th>--}}
{{--            <th>المبلغ المدفوع</th>--}}
{{--            <th>المورد</th>--}}
{{--            <th>طريقة الدفع</th>--}}
{{--            <th>شراء</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--                    @foreach($data['data'] as $i)--}}
{{--                        <tr>--}}
{{--                            <td>{{$i->name}}</td>--}}
{{--                            <td>{{$i->price}}</td>--}}
{{--                            <td>{{$i->quantity}}</td>--}}
{{--                            <td>{{$i->dis_account.'%'}}</td>--}}
{{--                            <td>--}}
{{--                                {{( $i->price -  ($i->price * ($i->dis_account / 100))) * $i->quantity }}--}}
{{--                            </td>--}}
{{--                            <td>{{$i->note}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--        @for($i = 0; $i <= 500; $i++)--}}
{{--            <tr>--}}
{{--                <td>{{$i}}</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>1111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>{{$i}}</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>1111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>{{$i}}</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>11111</td>--}}
{{--                <td>1111</td>--}}
{{--                <td>11111</td>--}}
{{--            </tr>--}}

{{--        @endfor--}}

{{--        <tr>--}}
{{--            <th>المجموع:</th>--}}
{{--            <td>المجموع:</td>--}}
{{--            <td>42,5151515</td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--        </tr>--}}
{{--    </table>--}}
</div>
</body>
</html>


