@extends('admin.layout.header')
@section('admin_content')
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
        <!-- Right -->
        <a href="#"><strong><span class="fa fa-dashboard"></span> Admin Dashboard</strong></a>

        <div class="container">
            <hr>
            <a href="{{url('/generateReport')}}"><button class="btn btn-info">Generate Report</button></a>
            <div class="row">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">Users</h3>
                        <div class="pull-right">
{{--                            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>--}}
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr class="filters">
                            <th>Id</th>
                            <th>Order_Id</th>
                            <th>Comment</th>
                            <th>Against</th>
                            <th>Created-By</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $complains = \App\Models\Complain::all();
                            @endphp
                        @foreach($complains as $complain)
                            <tr>
                                <td>{{$complain->id}}</td>
                                <td>{{$complain->order_id}}</td>
                                <td>{{$complain->comment}}</td>
                                <td>{{$complain->getComplains? $complain->getComplains->name : 'Null'}}</td>
                                <td>{{$complain->created_by}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr>
    </div>

@endsection
