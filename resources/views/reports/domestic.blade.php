<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <style>
        .table-bordered, .table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
            border: 1px solid #000 !important;
        }
    </style>

</head>
<body style="background: #fff !important; font-size: 12px; color: #000 !important;">
<div class="container-fluid">

    <section>
        <h1 class="text-center">PAX</h1>
        <h4 class="text-center">Pan African Express Transport Ltd</h4>
        <h4 class="text-center"><strong>REGIONAL WAYBILL</strong></h4>

        <br>
        <br>

        <div class="row border-bottom">
            <div class="col-xs-7">
                <h6>1. FROM</h6>
                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Date
                    </div>
                    <div class="col-xs-3">
                        {{ Carbon\Carbon::parse($domestic->created_at)->format('d/m/Y') }}
                    </div>
                    <div class="col-xs-4">
                        Sender's Account
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->client ? $domestic->client->Account : '' }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Sender
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_name }}
                    </div>
                    <div class="col-xs-3">
                        Phone
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_phone }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Company
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_company }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_address }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_address_alternate }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        City
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->from->name }}
                    </div>
                    <div class="col-xs-3">
                        Country
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_country }}
                    </div>
                </div>

                <h6>2. TO</h6>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Recipient
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_name }}
                    </div>
                    <div class="col-xs-3">
                        Phone
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_phone }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Company
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_company }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_address }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_address_alternate }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        City
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->to->name }}
                    </div>
                    <div class="col-xs-3">
                        Country
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_country }}
                    </div>
                </div>


                <h6>3. SHIPMENT INFORMATION</h6>

                <div class="row ">
                    <div class="col-xs-4">
                        Total Packages
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->total_package }}
                    </div>
                    <div class="col-xs-4">
                        Total Weight (KGs)
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->weight }}
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-xs-12">
                        <table class="table plain-table table-bordered">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Currency</th>
                                <th class="text-right">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $domestic->shipment_description }}</td>
                                <td></td>
                                <td class="text-right">{{ number_format($domestic->shipment_value, 2) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <h6>4. PACKAGING</h6>

                <div class="row border-bottom">
                    <div class="col-xs-12">
                        {{ $domestic->package() }}
                    </div>
                </div>

                <br>

            </div>

            <div class="col-xs-5">
                <div class="col-xs-12">
                    <img src="data:image/png;base64, {{ $barcode }}"
                         style="max-width: 80%; height: 40px; display: block; margin: 0 auto;">
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">{{ $domestic->number }}</h5>
                </div>

                <div class="col-xs-12">
                    <p class="text-justify bordered p10" style="font-size: 10px">
                        Use of this waybill constitutes your agreement to the PAX conditions for the carriage for EAST AFRICA,
                        an extract of which can be found from http://paxapps.com/download/terms.jpg and you represent
                        that this shipment does not contain dangerous goods. Certain international treaties, including
                        the Warsaw Convention, may apply to this shipment and limit our liability for damage, loss or
                        delay, as described in our conditions for carriage for EAST AFRICA.
                    </p>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">SHIPPER'S SIGNATURE</h5>
                    <div class="bordered p20">
                        <br>
                    </div>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">PICKUP COURIER</h5>
                    <div class="bordered p20">
                        <br>
                    </div>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered p10">
                        SHIPMENT COPY
                    </h5>
                </div>
            </div>

        </div>
    </section>

    <div class="page-break"></div>
    <section>
        <h1 class="text-center">PAX</h1>
        <h4 class="text-center">Pan African Express Transport Ltd</h4>
        <h4 class="text-center"><strong>REGIONAL WAYBILL</strong></h4>

        <br>
        <br>

        <div class="row border-bottom">
            <div class="col-xs-7">
                <h6>1. FROM</h6>
                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Date
                    </div>
                    <div class="col-xs-3">
                        {{ Carbon\Carbon::parse($domestic->created_at)->format('d/m/Y') }}
                    </div>
                    <div class="col-xs-4">
                        Sender's Account
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->client ? $domestic->client->Account : '' }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Sender
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_name }}
                    </div>
                    <div class="col-xs-3">
                        Phone
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_phone }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Company
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_company }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_address }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_address_alternate }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        City
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->from->name }}
                    </div>
                    <div class="col-xs-3">
                        Country
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_country }}
                    </div>
                </div>

                <h6>2. TO</h6>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Recipient
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_name }}
                    </div>
                    <div class="col-xs-3">
                        Phone
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_phone }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Company
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_company }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_address }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_address_alternate }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        City
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->to->name }}
                    </div>
                    <div class="col-xs-3">
                        Country
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_country }}
                    </div>
                </div>


                <h6>3. SHIPMENT INFORMATION</h6>

                <div class="row ">
                    <div class="col-xs-4">
                        Total Packages
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->total_package }}
                    </div>
                    <div class="col-xs-4">
                        Total Weight (KGs)
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->weight }}
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-xs-12">
                        <table class="table plain-table table-bordered">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Currency</th>
                                <th class="text-right">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $domestic->shipment_description }}</td>
                                <td></td>
                                <td class="text-right">{{ number_format($domestic->shipment_value, 2) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <h6>4. PACKAGING</h6>

                <div class="row border-bottom">
                    <div class="col-xs-12">
                        {{ $domestic->package() }}
                    </div>
                </div>

                <br>

            </div>

            <div class="col-xs-5">
                <div class="col-xs-12">
                    <img src="data:image/png;base64, {{ $barcode }}"
                         style="max-width: 80%; height: 40px; display: block; margin: 0 auto;">
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">{{ $domestic->number }}</h5>
                </div>

                <div class="col-xs-12">
                    <p class="text-justify bordered p10" style="font-size: 10px">
                        Use of this waybill constitutes your agreement to the PAX conditions for the carriage for EAST AFRICA,
                        an extract of which can be found from http://paxapps.com/download/terms.jpg and you represent
                        that this shipment does not contain dangerous goods. Certain international treaties, including
                        the Warsaw Convention, may apply to this shipment and limit our liability for damage, loss or
                        delay, as described in our conditions for carriage for EAST AFRICA.
                    </p>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">SHIPPER'S SIGNATURE</h5>
                    <div class="bordered p20">
                        <br>
                    </div>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">PICKUP COURIER</h5>
                    <div class="bordered p20">
                        <br>
                    </div>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered p10">
                        COURIER'S COPY
                    </h5>
                </div>
            </div>

        </div>
    </section>

    <div class="page-break"></div>
    <section>
        <h1 class="text-center">PAX</h1>
        <h4 class="text-center">Pan African Express Transport Ltd</h4>
        <h4 class="text-center"><strong>REGIONAL WAYBILL</strong></h4>

        <br>
        <br>

        <div class="row border-bottom">
            <div class="col-xs-7">
                <h6>1. FROM</h6>
                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Date
                    </div>
                    <div class="col-xs-3">
                        {{ Carbon\Carbon::parse($domestic->created_at)->format('d/m/Y') }}
                    </div>
                    <div class="col-xs-4">
                        Sender's Account
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->client ? $domestic->client->Account : '' }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Sender
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_name }}
                    </div>
                    <div class="col-xs-3">
                        Phone
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_phone }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Company
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_company }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_address }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->shipper_address_alternate }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        City
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->from->name }}
                    </div>
                    <div class="col-xs-3">
                        Country
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->shipper_country }}
                    </div>
                </div>

                <h6>2. TO</h6>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Recipient
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_name }}
                    </div>
                    <div class="col-xs-3">
                        Phone
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_phone }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Company
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_company }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_address }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        Address
                    </div>
                    <div class="col-xs-9">
                        {{ $domestic->con_address_alternate }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-xs-3">
                        City
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->to->name }}
                    </div>
                    <div class="col-xs-3">
                        Country
                    </div>
                    <div class="col-xs-3">
                        {{ $domestic->con_country }}
                    </div>
                </div>


                <h6>3. SHIPMENT INFORMATION</h6>

                <div class="row ">
                    <div class="col-xs-4">
                        Total Packages
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->total_package }}
                    </div>
                    <div class="col-xs-4">
                        Total Weight (KGs)
                    </div>
                    <div class="col-xs-2">
                        {{ $domestic->weight }}
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-xs-12">
                        <table class="table plain-table table-bordered">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Currency</th>
                                <th class="text-right">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $domestic->shipment_description }}</td>
                                <td></td>
                                <td class="text-right">{{ number_format($domestic->shipment_value, 2) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <h6>4. PACKAGING</h6>

                <div class="row border-bottom">
                    <div class="col-xs-12">
                        {{ $domestic->package() }}
                    </div>
                </div>

                <br>

            </div>

            <div class="col-xs-5">
                <div class="col-xs-12">
                    <img src="data:image/png;base64, {{ $barcode }}"
                         style="max-width: 80%; height: 40px; display: block; margin: 0 auto;">
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">{{ $domestic->number }}</h5>
                </div>

                <div class="col-xs-12">
                    <p class="text-justify bordered p10" style="font-size: 10px">
                        Use of this waybill constitutes your agreement to the PAX conditions for the carriage for EAST AFRICA,
                        an extract of which can be found from http://paxapps.com/download/terms.jpg and you represent
                        that this shipment does not contain dangerous goods. Certain international treaties, including
                        the Warsaw Convention, may apply to this shipment and limit our liability for damage, loss or
                        delay, as described in our conditions for carriage for EAST AFRICA.
                    </p>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">SHIPPER'S SIGNATURE</h5>
                    <div class="bordered p20">
                        <br>
                    </div>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered">PICKUP COURIER</h5>
                    <div class="bordered p20">
                        <br>
                    </div>
                </div>

                <div class="col-xs-12">
                    <h5 class="text-center bordered p10">
                        CUSTOMER'S COPY
                    </h5>
                </div>
            </div>

        </div>
    </section>



</div>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <script>
        setTimeout(function () {
            window.print();
        }, 500);
        setTimeout(function () {
            window.close();
        }, 600);
    </script>
</body>
</html>