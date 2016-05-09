<!DOCTYPE html>
<html>
<head>
<title>Online Athlete Management</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>
	<script type="text/javascript" language="javascript" src="/addons/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
	     <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">
     <script src="/addons/js/bootstrap.js"></script>

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
    background-color: rgb(50,50,50);
    overflow-x: hidden;
    }
    .navigation{
        background-color: #2b579a;
    }
    span{
        position: relative;
        margin-left: -3px;
        margin-right: -3px;
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
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/OAMS/coach/Athlete/1/asc"><div style="position: relative;margin-top: -10px;"><span><img src="/addons/icons/nu.png" height="45" width="45">National University Athletics</span><font style="color: #ffff00;">{{$_SESSION['type']}}</font></div></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img width="32px" height="32px" src="{{$_SESSION['user_info']->profile_pic}}"> {{$_SESSION['user_info']->firstname}} {{$_SESSION['user_info']->surname}} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{route('viewEditProfile')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="/OAMS/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>
		<div class="container-fluid">
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="panel">
        <div class="panel-heading heads"><center><h4 style="color:white;"><span class="glyphicon glyphicon-copy"></span>Modules</h4></center></div>
        <div class="body">
		<ul class="nav menu">
			<li class="active"><a href="{{route('viewAthlete')}}"><img height="32" width="32" src="/addons/icons/22.png"> Athlete's Profile</a></li>
			<li><a href="{{route('viewCalendarSchedule')}}">&nbsp;&nbsp;<svg class="glyph stroked calendar" height="32" width="32" style="color: #717171;"><use xlink:href="#stroked-calendar"></use></svg> Schedule</a></li>
			<li><a href="{{route('roster')}}"><img height="32" width="32" src="/addons/icons/24.png"> Roster Creation</a></li>
			<li><a href="/OAMS/coach/playerStatistics/1"><img height="32" width="32" src="/addons/icons/14.png"> Game Statistics</a></li>
			<li><a href="/OAMS/coach/Applicant/1">&nbsp;&nbsp;<span style="height: 32px;width: 32px; color:#717171;" class="glyphicon glyphicon-send"></span>Applicants</a></li>
			<li><a href="/OAMS/coach/Blog/1">&nbsp;&nbsp;<svg style="color:#717171;" class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Homescreen Posts</a></li>

        </ul>
        </div>
          <br/><br/><br/><br/><br/>
                <hr>
                <div style="margin-left: 3%;" class="dateTime"><span class="glyphicon glyphicon-calendar"></span></div>
        </div>

	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
         @yield('contents')
		</div><!--/.row-->
	</div>	<!--/.main-->
    @yield('popup')


</body>

</html>
