<html moznomarginboxes mozdisallowselectionprint>

<head>
    <title>E-Shop - Print Nota</title>
    <style type="text/css">
        html {
            font-family: "Verdana, Arial";
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <b>E-Shop</b>
        </div>

        <div class="head">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width: 200px">
                        @php
                            use Carbon\Carbon;
                            $date = Carbon::parse($data[0]->created_at);
                        @endphp

                        {{ $date->translatedFormat('d, F Y') }}
                    </td>
                    <td>Customer</td>
                    <td style="text-align:center; width:10px">:</td>
                    <td style="text-align:right;">
                        {{ $data[0]->first_name }}
                    </td>
                </tr>
                {{-- <tr>
                    <td>
                        Invoice Number
                    </td>
                    <td>Customer</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right;">
                        Customer
                    </td>
                </tr> --}}
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">

                @foreach ($data_detail as $item)
                    <tr>
                        <td style="width: 165px">{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align:right; width:60px">{{ number_format($item->price) }}</td>
                        <td style="text-align:right; width:60px">
                            {{ number_format($item->price * $item->quantity) }}
                        </td>
                    </tr>
                @endforeach


                <tr>
                    <td colspan="4" style="border-bottom: 1px dashed; padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding: 5px 0;">Total</td>
                    <td style="text-align: right; padding: 5px 0;">
                        {{ number_format($data[0]->total_amount) }}
                    </td>
                </tr>
                {{-- <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding: 5px 0;">Diskon</td>
                    <td style="text-align: right; padding: 5px 0;">
                        Diskon
                    </td>
                </tr> --}}
                {{-- <tr>
                    <td colspan="2"></td>
                    <td style="border-top: 1px dashed; text-align:right; padding: 5px 0">Total Akhir</td>
                    <td style="border-top: 1px dashed; text-align:right; padding: 5px 0">
                        Harga Akhir
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="border-top: 1px dashed; text-align:right; padding: 5px 0">Diabayarkan</td>
                    <td style="border-top: 1px dashed; text-align:right; padding: 5px 0">
                        Cash
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align:right;">Kembalian</td>
                    <td style="text-align:right;">
                        Kembalian
                    </td>
                </tr> --}}
            </table>
        </div>
        <div class="thanks">
            --- Thank You ---
            <br>
            E-Shop
        </div>
    </div>
</body>

</html>
