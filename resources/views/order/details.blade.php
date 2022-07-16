@extends('layouts.app')
@section('body')
<div class="row mt-4 h-100">
    <div class="col-md-6 my-auto">
        <h1>Order ID: {{ $order['OrderNumber'] }}</h1>
    </div>
    <div class="col-md-6 form-group ">
        <div class="row">
            <div class="col-md-5">
                <form action="{{route('assign.order',[ 'order_id' => $order['OrderNumber'] ])}}" method="POST">
                @csrf
                <label for="assign_to" style="font-size: 12px;">Assigned To : </label>
                <select name="assign_to" id="assign_to" class="form-control">
                    <option value="0">Assign To</option>
                    @foreach ($users as $user)
                        <option value="{{$user -> id}}" @if($assigned_to == $user -> id ) selected  @endif  >
                            {{$user -> name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="assign_to" style="font-size: 12px;">Status </label>
                <select name="status" id="assign_to" class="form-control">
                        <option value="referred"  >
                            Referred
                        </option>
                        <option value="closed" @if($status == 'closed') selected @endif) >
                            Closed
                        </option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="form-control btn btn-primary" style="margin-top:28px">Save</button>
            </div>
        </form>
        </div>

    </div>
</div>
<hr>
<div>
    <h2>Logs :</h2>
    <div class="row">
        <div class="card mx-3 my-2 p-3 w-100 overflow-auto h-50">
        @forelse ($logs as $log)
            <div class="flex ">
                <div class="d-flex flex-row justify-content-between">
                    <p><b>{{isset($log -> user) ? $log -> user -> name : 'DELETED USER'}} :</b> {{$log -> body}}</p>
                    <span>
                    @if($log->high_priority == 1)
                        <img src="/images/circle-xxl.png" style="height: 18px;margin-right: 5px;margin-bottom: 3px;"alt="">
                    @endif
                        {{$log -> created_at}}
                    </span>
                </div>
                <div>
                    <style>
                        .customIcon{
                            display: flex;
                            justify-content: flex-start;
                            align-items: center;
                        }.customIcon .icon{
                                                     width: 18px;
                                                     display: flex;
                                                     justify-content: center;
                                                     align-items: center;
                                                     margin-left: 6px;
                                                 }
                    </style>
                </div>
                @if(isset($log -> attachment))
                    <div class="flex text-center">
                        @php
                            $extension = pathinfo(storage_path($log->attachment), PATHINFO_EXTENSION);
                            $videoExtensions=['webm','MP4','MKV','MOV','WMV','AVI'];
                            $imgExtensions=['png','jpeg','gifs','jpg'];
                            $docExtensions=['txt','pdf','docx','pptx','exe','zip'];
                        @endphp
                        @if(in_array($extension,$videoExtensions))

                            <video width = "250" height="250" controls>
                                <source src="{{$log -> attachment}}" type="video/{{$extension}}">
                            </video>
                        @elseif(in_array($extension,$imgExtensions))
                            <img height="250" weight="250" src="{{$log -> attachment}}" alt="No image found">
                        @else
                            <p>
                                <iframe allow="fullscreen" height="300px" src="{{$log -> attachment}}">Document</iframe>
                            </p>
                        @endif
                        <div>
                            <a href="{{$log -> attachment}}" download rel="noopener noreferrer" target="_blank">
                                Download
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <span style="text-align: center;">No log found.</span>
        @endforelse
        </div>
    </div>
</div>
<div class="flex ">
    <form method="POST" action="{{route('logs.store')}}" class="w-full" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <select class="js-example-basic-multiple form-control" name="users[]" multiple="multiple" placeholder = "Notify to">
            @foreach ($users as $user)
                <option value="{{$user -> id}}">{{$user -> name}}</option>
            @endforeach
        </select>
        </div>
        <input type="hidden" name="order_id" value="{{$order['OrderNumber']}}">
        <div class="form-group">
            <!-- <label for="">Logs</label> -->
            <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter a Log..." required></textarea>
        </div>
        <div class="form-group">
            <input type="checkbox" id="high_priority" name="high_priority">
            <label for="high_priority"><b>High Priority</b></label>
        </div>
        <div class="form-group">
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <div class="form-group">
            <div class="text-right">
                <button type="submit" class="btn btn-primary mb-2">Save</button>
            </div>
        </div>
    </form>
</div>

{{--Complain Box--}}

<div class="flex">
    <h3>Complain Box</h3>
    <form method="POST" action="{{url('complain')}}" class="w-full" id="complain-box">
        @csrf
        <div class="form-group">
            <select class="js-example-basic-multiple form-control"  id="users" name="against[]" multiple="multiple" placeholder = "Helooooo">
                <option>Select</option>
                @foreach ($users as $user)
                    <option value="{{$user -> id}}">{{$user -> name}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" id="order_id" name="order_id" value="{{$order['OrderNumber']}}">
        <div class="form-group">
            <!-- <label for="">Logs</label> -->
            <textarea name="comment" id="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter logs" required></textarea>
        </div>

        <div class="form-group">
            <div class="text-right">
                <button type="submit" class="btn btn-primary mb-2">Save</button>
            </div>
        </div>
    </form>

</div>

{{--return order--}}

<div class="flex">
    @role('users')
    <button class="btn btn-info" type="submit" id="returnbox">Return Order</button>
    @endrole
    <div class="return" style="display: none" >
        <h4>Return Order</h4>
            <form method="POST" action="{{url('/returnOrder')}}" class="w-full" id="returnOrder">
                @csrf
                <input type="hidden" id="order_id" name="order_id" value="{{$order['OrderNumber']}}">
                <input type="hidden" id="created_by" name="created-by" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                <div class="form-group">
                    <!-- <label for="">Logs</label> -->
                    <textarea name="body" id="body" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter the reason" required></textarea>
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mb-2">Save</button>
                    </div>
                </div>
            </form>
    </div>
</div>


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
                        <tr class="text-center">
                            <th scope="col">Details</th>
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
@endsection
@section('extra_js')
    <script>
        // $('#assign_to').change(function(){
        //     $(this).closest('form').submit();
        // })
        $('#returnbox').click( function (){
            $('.return').toggle();
        });
    </script>
@endsection

