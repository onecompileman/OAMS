<!DOCTYPE html>
<html>
<head>
<title>Online Athlete Management</title>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Lumino - Dashboard</title>
     <script src="/addons/js/jquery.js"></script>

     <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">

     <link rel="stylesheet" href="/addons/css/jasny-bootstrap.min.css" />
                <link rel="stylesheet" href="/addons/css/jasny-bootstrap-responsive.min.css" />
    <script src="/addons/js/jasny-bootstrap.js"></script>
    <style>
     body::-webkit-scrollbar{
                background-color: #1a4d6e;
                        width: 5px;
             }
             body::-webkit-scrollbar-thumb{
                          background-color: #22cff6;
                      }
                      .modal::-webkit-scrollbar{
                        background-color: #1a4d6e;
                                                width: 5px;
                      }
                      .modal::-webkit-scrollbar-thumb{
                                                      background-color: #22cff6;
                                                  }
    </style>
	<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>


       <script src="/addons/js/easypiechart.js"></script>
       	<script src="/addons/js/easypiechart-data.js"></script>
       	<script src="/addons/js/chart.min.js"></script>
        	<script src="/addons/js/chart-data.js"></script>
        	<link href='/addons/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
            <link href='/addons/fullcalendar-2.6.1/fullcalendar.print.css' rel='stylesheet' media='print' />
            <script src='/addons/fullcalendar-2.6.1/lib/moment.min.js'></script>
            <script src='/addons/fullcalendar-2.6.1/lib/jquery.min.js'></script>
            <script src='/addons/fullcalendar-2.6.1/fullcalendar.min.js'></script>
<link href="/addons/css/styles.css" rel="stylesheet">
<style>
    .panel{
        box-shadow: rgba(0,0,0,0.5);
    }
    .panel-heading h4{
        text-align:center;
        color:white;
    }
    .heads{
        background-color:#005599;
        color: white;
    }
    body{
    overflow-x: hidden;
    background-color:#c7d1dd;
    }
    .navigation{
        background-color:#0b2644;
    }
    span{
        position: relative;
        margin-left: -3px;
        margin-right: -3px;
    }
    a{
    cursor:pointer;
    }
    .clicked{
       color: #006dcc;
    }
</style>

<script src="/addons/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="/addons/js/html5shiv.js"></script>
<script src="/addons/js/respond.min.js"></script>
<![endif]-->
<script>
    $(document).ready(function(){
       setInterval(function(){
           var today = new Date();
           var dd = today.getDate();
           var mm = today.getMonth()+1; //January is 0!
           var yyyy = today.getFullYear();

           if(dd<10) {
               dd='0'+dd;
           }

           if(mm<10) {
               mm = '0' + mm;
           }

           today = mm+'/'+dd+'/'+yyyy+'&nbsp;&nbsp;&nbsp;  <span class="glyphicon glyphicon-time" style="color: #0044cc;"></span>'+today.getHours()+":"+today.getMinutes()+":"+today.getSeconds();
           $('.dateTime').html('<span class="glyphicon glyphicon-calendar" style="color:#f7ce42;"></span>'+ today);
       },1000)
    });
</script>
   @yield ("css")
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top navigation" role="navigation">
	<?php if(!isset($_SESSION)) session_start();?>
		<div class="container-fluid">
			<div class="row">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                <div class="col-md-6">
                    <a class="navbar-brand" href="/OAMS/coach/Athlete/1/asc"><div style="position: relative;margin-top: -10px;"><span><img src="/addons/icons/nu.png" height="45" width="45">National University Athletics</span><font style="color: #ffff00;">{{$_SESSION['type']}}</font></div></a>
            </div>
            <div class="col-md-1 col-sm-offset-3">
            <ul class="user-menu">
                            					<li class="dropdown pull-right">
                            						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"><span class="label label-danger">7</span></span></a>
                            						<ul class="dropdown-menu" role="menu">
                            						<!--	<li><a href="{{route('viewEditProfile')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                            							<li><a href="/OAMS/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            						-->
                            						</ul>
                            					</li>
                            				</ul>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<ul class="user-menu ">
                					<li class="dropdown pull-right">
                						<a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="glyphicon glyphicon-envelope" id="messageTab">@if($messagecount > 0)<span class="label label-danger">{{$messagecount}}</span>@endif</span></a>
                						<ul class="dropdown-menu" role="menu">
                							<!--<li><a href="{{route('viewEditProfile')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                							<li><a href="/OAMS/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>-->
                							<li><a href="/OAMS/admin/message"><span class="glyphicon glyphicon-send"></span>   Send Message</a></li><li><a href="/OAMS/admin/message?type=inbox"><span class="glyphicon glyphicon-inbox"><span class="badge"></span></span>  Inbox</a></li><li><a href="/OAMS/admin/message?type=outbox"><span class ="glyphicon glyphicon-upload"><span class="bagde"></span></span>     &nbsp;  Outbox</a></li>
                						</ul>
                					</li>
                				</ul>
                				</div>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img width="32px" height="32px" src="/sys_files/img/profile_pic/staff/{{$_SESSION['user_info']->profile_pic}}"> {{$_SESSION['user_info']->firstname}} {{$_SESSION['user_info']->surname}} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{route('viewEditProfile')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="{{route('adminActivity')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-clipboard-with-paper"></use></svg> Activity Log</a></li>
							<li><a href="/OAMS/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
    </div>
		</div><!-- /.container-fluid -->
	</nav>
		<div class="container-fluid">
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar" style="background-color: #09192a;">
        <div class="panel" style="background-color: #09192a;">
        <div class="panel-heading heads" style="background-color: #1d2d3e;"><center><h4 style="color:white;"><span class="glyphicon glyphicon-copy"></span>Modules</h4></center></div>
        <div class="body">
		<ul class="nav menu">
		    <li><a href="{{route('adminHome')}}">&nbsp;&nbsp;<span style="color:rgb(130,130,130);" class="glyphicon glyphicon-home"></span> Home</a></li>
			<li><a href="{{route('adminviewAthlete')}}"><img height="32" width="32" src="/addons/icons/22.png"> Athlete's Profile</a></li>
			<li><a href="{{route('adminSchedule')}}">&nbsp;&nbsp;<svg class="glyph stroked calendar" height="32" width="32" style="color: #717171;"><use xlink:href="#stroked-calendar"></use></svg> Schedule</a></li>
			<li><a href="{{route('adminViewCoach')}}"><img height="32" width="32" src="/addons/icons/24.png"> Coaches Profile </a></li>
			<li><a href="/OAMS/coach/playerStatistics/1"><img height="32" width="32" src="/addons/icons/14.png"> Game Statistics</a></li>
			<li><a href="{{route('adminViewApplicants')}}">&nbsp;&nbsp;<span style="height: 32px;width: 32px; color:#717171;" class="glyphicon glyphicon-send"></span>Applicants</a></li>
			<li><a href="{{route('adminCMS')}}">&nbsp;&nbsp;<svg style="color:#717171;" class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Website CMS</a></li>

        </ul>
        </div>
          <br/><br/><br/><br/><br/>
                <hr>
                <div style="margin-left: 3%;color:#2b98eb;" class="dateTime"><span class="glyphicon glyphicon-calendar"></span></div>
        </div>

	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	    <br/>
         @yield('contents')
		</div><!--/.row-->
	</div>	<!--/.main-->
    @yield('popup')


</body>

</html>
