@extends('admin.layout.header')
{{--@extends('admin.layout.header')--}}
@section('admin_content')
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
        <!-- Right -->
        <a href="#"><strong><span class="fa fa-dashboard"></span> Admin Dashboard</strong></a>
        <hr>
    </div>

    <script>
   $('#filter_tab').click( function (){
       $('.filterable_tab').toggle();
   })
    </script>
@endsection

{{--,startDate:startDate,endDate:endDate--}}
