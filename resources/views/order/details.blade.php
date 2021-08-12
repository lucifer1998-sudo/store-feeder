@extends('layouts.app')
@section('body')
<h1>Order ID: {{ $order['OrderNumber'] }}</h1>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header text-center ">
                Order Information
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Order Number :</b> {{ $order['OrderNumber'] ?? 'N/A' }}</li>
                <li class="list-group-item"><b>Company Identity : </b> {{$order['CompanyIdentity']['CompanyIdentityName'] ?? 'N/A'}}</li>
                <li class="list-group-item"> <b>Channel Purchased From : </b>{{$order['Channel']['ChannelName'] ?? 'N/A'}}</li>
                <li class="list-group-item"><b>Channel Order Number : </b>{{ $order ['ChannelOrderRef'] }} </li>
                <li class="list-group-item"><b>Order Status : </b>  {{$order['OrderStatus']}} </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Order Process Details
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Order Date :</b> {{ $order['OrderDate'] ?? 'N/A' }}</li>
                <li class="list-group-item"><b>Imported from Channel on : </b> {{$order['ImportDate'] ?? 'N/A'}}</li>
                <li class="list-group-item"> <b>Assigned to Picker on : </b>-</li>
                <li class="list-group-item"><b>Pickwave ID : </b>- </li>
                <li class="list-group-item"><b>Despatched on : </b>  {{$order['DespatchDate'] ?? 'N/A'}} </li>
                <li class="list-group-item"><b>Despatch sent to Channel : </b>  {{$order['DespatchSentToChannelDate'] ?? 'N/A'}} </li>
                <li class="list-group-item"><b>Updated as shipped on Channel : </b>  - </li>
                <li class="list-group-item"><b>Designated Picker : </b>  - </li>
                <li class="list-group-item"><b>Designated Packer : </b>  - </li>
                <li class="list-group-item"><b>Signed for by : </b>  - </li>
                <li class="list-group-item"><b>Payment ID : </b>  {{$order['PaymentID'] ?? 'N/A'}} </li>
                <li class="list-group-item"><b>Delivered on : </b>  - </li>
                <li class="list-group-item"><b>Manifested on : </b>  - </li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card my-4" >
            <div class="card-header">
                Customer
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Customer :</b> {{ $order['Customer']['FirstName'] .' '. $order['Customer']['LastName'] ?? 'N/A' }}</li>
                <li class="list-group-item"><b>Phone : </b> {{$order['Shippingaddress']['PhoneNumber'] ?? 'N/A'}}</li>
                <li class="list-group-item"> <b>Email : </b>{{$order['Customer']['Email'] ?? 'N/A'}}</li>
                <li class="list-group-item">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Billing Address</th>
                            <th scope="col">Shipping Address</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{$order['BillingAddress']['FirstName'] .' '. $order['BillingAddress']['LastName']  ?? 'N/A'}}</td>
                            <td>{{$order['Shippingaddress']['FirstName'] .' '. $order['Shippingaddress']['LastName']  ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Company</th>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="row">Address 1</th>
                            <td>{{$order['BillingAddress']['Address1']  ?? 'N/A'}}</td>
                            <td>{{$order['Shippingaddress']['Address1']  ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Address 2</th>
                            <td>{{$order['BillingAddress']['Address2']  ?? 'N/A'}}</td>
                            <td>{{$order['Shippingaddress']['Address2']  ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">City</th>
                            <td>{{$order['BillingAddress']['City']  ?? 'N/A'}}</td>
                            <td>{{$order['Shippingaddress']['City']  ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">PostCode</th>
                            <td>{{$order['BillingAddress']['Postcode']  ?? 'N/A'}}</td>
                            <td>{{$order['Shippingaddress']['Postcode']  ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Phone Number</th>
                            <td>{{$order['BillingAddress']['PhoneNumber']  ?? 'N/A'}}</td>
                            <td>{{$order['Shippingaddress']['PhoneNumber']  ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Country</th>
                            <td>{{$order['BillingAddress']['Country']  ?? 'N/A'}}</td>
                            <td>{{$order['Shippingaddress']['Country']  ?? 'N/A'}}</td>
                        </tr>
                        </tbody>
                    </table>
                </li>

            </ul>
        </div>
    </div>
</div>

<h3 class="font-3xl text-primary">Items Ordered</h3>
<div class="flex flex-wrap">
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">Product ID</th>
        <th scope="col">SKU</th>
        <th scope="col">Product Name</th>
        <th scope="col">Qty Sent</th>
        <th scope="col">Qty Returned</th>
        <th scope="col">Total Amount</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($order['OrderLines']))
            @foreach ($order['OrderLines'] as $product)
            <tr>
                <td>{{ $product['Product']['ProductID'] }}</td>
                <td>{{ $product['Product']['SKU'] }}</td>
                <td>{{ $product['OrderedProductName'] }}</td>
                <td>{{ $product['QuantitySent'] }}</td>
                <td>{{ $product['QuantityReturned'] }}</td>
                <td>{{ $product['TotalItemPriceIncVat'] }}</td>
                <td>{{ $product['LineStatus'] }}</td>
            </tr>
            @endforeach
        @endif

    </tbody>
    </table>
</div>
<div>
    <h2>Logs :</h2>
    @foreach ($logs as $log)
    <div class="row">
        <div class="card m-3 p-3 w-100">
            <p><b>{{isset($log -> user) ? $log -> user -> name : 'DELETED USER'}} :</b> {{$log -> body}}</p><br>
        </div>
    </div>
    @endforeach
</div>
<div class="flex ">
    <form method="POST" action="{{route('logs.store')}}" class="w-full">
    @csrf
    <input type="hidden" name="order_id" value="{{$order['OrderNumber']}}">
    <div class="form-group">
        <!-- <label for="">Logs</label> -->
        <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter a Log..." required></textarea>
    </div>
    <div class="form-group">
        <div class="text-right">
            <button type="submit" class="btn btn-primary mb-2">Save</button>
        </div>
    </div>
    </form>

</div>

@endsection
