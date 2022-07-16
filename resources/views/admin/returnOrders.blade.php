@extends('admin.layout.header')
@section('admin_content')
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
        <!-- Right -->
        <a href="#"><strong><span class="fa fa-dashboard"></span> Admin Dashboard</strong></a>

        <div class="container">
            <hr>
            <a href="{{url('/returnOrderReport')}}"><button class="btn btn-info">Generate Report</button></a>
            <button class="btn btn-info" id="filter_tab" type="submit">Filters</button>
            <br><br>
            <div class="container-fluid filterable_tab" style="display: none" >
                @php
                    $orders = \App\Models\Order::all();
                @endphp
                <form action="filteredData" method="get">
                    <select name="orderid" id="orderid"  class="dropdown" onchange="filterdata('filterable')">
                        <option value="">Select_Order_Id</option>
                        @foreach($orders as $order)
                            <option value="{{$order->id}}">{{$order->id}}</option>
                        @endforeach
                        {{-- </optgroup> --}}
                    </select>
                    <label for="startDate">From</label>
                    <input type="date" name="startDate" id="startDate" onchange="filterdata('filterable')" >
                    <label for="endDate">To</label>
                    <input type="date" name="endDate" id="endDate" onchange="filterdata('filterable')">

                </form>
            </div>
            <div class="row">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">Returned Orders</h3>
                        <div class="pull-right">
                            {{--                            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>--}}
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr class="filters">
                            <th>Id</th>
                            <th>Order_Id</th>
                            <th>Reason</th>
                            <th>Created-By</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @php--}}
{{--                            $returnOrders = \App\Models\ReturnOrder::all();--}}
{{--                        @endphp--}}
                        @foreach($returnOrders as $returnOrder)
                            <tr>
                                <td>{{$returnOrder->id}}</td>
                                <td>{{$returnOrder->order_id}}</td>
                                <td>{{$returnOrder->body}}</td>
                                <td>{{$returnOrder->created_by}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr>
    </div>

    <script>
        function filterdata(type){
            var orderid = $('#orderid').val();
            var startDate=$('#startDate').val();
            var endDate= $('#endDate').val();
            // console.log(orderid);
            // return
        $.ajax({
            url:'/returnReplacement',
            type:'GET',
            data:{orderid:orderid,type:type,startDate:startDate,endDate:endDate},
            success:function(data){
                $('.filterable').html(data.html);
            }
        });
        }
        $('#filter_tab').click(function (){
           $('.filterable_tab').toggle();
        });
    </script>
@endsection

{{--,startDate:startDate,endDate:endDate--}}
