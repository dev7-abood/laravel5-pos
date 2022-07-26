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
                    <p style="font-weight: bold">{{$businessData['name'] ?? ''}}</p>
                    <br/>
                    <p>{{$businessData['cr'] ? 'السجل التجاري '.$businessData['cr'] : ''}}</p>
                    <br/>
                    <p>{{$businessData['mobile'] ?? ''}}</p>
                </div>
            </td>
            <td class="table-none-border">
                <img width="140" height="140" alt=""
                     src="{{public_path('uploads/business_logos/'.$businessData['logo']) ?? ''}}">
            </td>
            <td class="table-none-border">
                <div>
                    <p style="font-weight: bold">{{$businessData['en_company_name'] ?? ''}}</p>
                    <br/>
                    <p>{{$businessData['cr'] ? 'Cr '.$businessData['cr'] : ''}}</p>
                    <br/>
                    <p>{{$businessData['mobile'] ?? ''}}</p>
                </div>
            </td>
        </tr>
    </table>
    <hr/>
    <br/>
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
                        {{$businessData['printTitle'] ?? ''}}
                    </div>
                </div>
            </td>
            <td class="table-none-border"></td>
        </tr>
    </table>
    <br>
    <br>
    <table>
        <thead>
        <tr>
            @foreach($keys as $index => $value)
                <th>{{$value->value}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
            <tr>
                @foreach($keys as $index => $value)
                    <td>{!! $d->{$value->key} !!} </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        {!! $tableFooter !!}
    </table>
</div>
</body>
</html>


