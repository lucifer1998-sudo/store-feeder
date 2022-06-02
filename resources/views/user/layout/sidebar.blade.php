<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
    <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">
        <!--<li class="nav-header"></li>-->
        <li><a href="{{url('/')}}"><i class="fa fa-search-minus"></i> Search</a></li>
        <li><a href="{{url('/user_dashboard')}}"><i class="fa fa-profile"></i> My Profile </a></li>
    </ul>
</div><!-- /span-3 -->

<script>
    $('.dropdown').click(function (){
        if($( ".dropdown-menu" ).hasClass("show")){
            $( ".dropdown-menu" ).addClass("hide")
        }
    })
</script>
