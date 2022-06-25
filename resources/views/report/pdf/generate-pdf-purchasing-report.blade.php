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
    <table>
        {{--    <caption><span style="font-weight: bold;margin-bottom: 10px">{{__('pdf.bill_number')}}</span>{{__('clint_name')}}</caption>--}}

        <thead repeat_header="0">
        <tr>
            <th>الرقم المرجعي</th>
            <th>المدفوعة على</th>
            <th>المبلغ المدفوع</th>
            <th>المورد</th>
            <th>طريقة الدفع</th>
            <th>شراء</th>
        </tr>
        </thead>


        {{--            @foreach($data['data'] as $i)--}}
{{--                <tr>--}}
{{--                    <td>{{$i->name}}</td>--}}
{{--                    <td>{{$i->price}}</td>--}}
{{--                    <td>{{$i->quantity}}</td>--}}
{{--                    <td>{{$i->dis_account.'%'}}</td>--}}
{{--                    <td>--}}
{{--                        {{( $i->price -  ($i->price * ($i->dis_account / 100))) * $i->quantity }}--}}
{{--                    </td>--}}
{{--                    <td>{{$i->note}}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}

        @for($i = 0; $i <= 100; $i++)
{{--            @if($i == 22)--}}
{{--                <pagebreak></pagebreak>--}}
{{--            @endif--}}
            <tr>
                <td>{{$i}}</td>
                <td>11111</td>
                <td>11111</td>
                <td>11111</td>
                <td>
                    1111
                </td>
                <td>11111</td>
            </tr>

        @endfor

        <tr>
            <th>المجموع:</th>
            <td>المجموع:</td>
            <td>42,5151515</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
</body>
</html>

