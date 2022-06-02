<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
    <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">
        <!--<li class="nav-header"></li>-->
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{url('/')}}"><i class="fa fa-search"></i> Search </a></li>
        <li><a href="{{url('/progress-report')}}" id="progress-report" >Progress-Report</a></li>
        <li><a href="{{url('/returnReplacement')}}" id="returnReplacement" >Return/Replacement</a></li>
        <li><a href="{{url('/dailyReports')}}" id="dailyReports" >Daily Reports</a></li>
    </ul>
</div><!-- /span-3 -->

<script>
    $('.dropdown').click(function (){
        if($( ".dropdown-menu" ).hasClass("show")){
            $( ".dropdown-menu" ).addClass("hide")
        }
    })
</script>
