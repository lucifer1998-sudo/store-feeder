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
