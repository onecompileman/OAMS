@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
     <script src="/addons/js/bootstrap.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            $('.nav').children('li:nth-child(1)').addClass('active');
        });
    </script>
    <style>

    </style>
@stop
@section('contents')
<h1><b>&nbsp;&nbsp;&nbsp;H O M E</b></h1>
<hr style="border: 2px solid #0b2644">
<br/><br/>
<div class="container-fluid">
<div class="row">
<div class="col-md-5 col-sm-offset-1">
    <a class="not" href="{{route('adminviewAthlete')}}">
	<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$athleteCount}}</div>
							<div class="text-muted">Athletes</div>
						</div>
					</div>
				</div>
				</a>
				</div>
				<div class="col-md-5 col-sm-offset-1">
				<div class="panel panel-orange panel-widget">
                					<div class="row no-padding">
                						<div class="col-sm-3 col-lg-5 widget-left">
                							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
                						</div>
                						<div class="col-sm-9 col-lg-7 widget-right">
                							<div class="large">{{$coachCount}}</div>
                							<div class="text-muted">Coaches</div>
                						</div>
                					</div>
                				</div>
                				</div>
                				</div>
                				<div class="row">
                				<div class="col-md-5 col-sm-offset-1">
                				<a href="{{route('adminviewAthlete')}}?sanc=1">
                				<div class="panel panel-red panel-widget">
                                                					<div class="row no-padding">
                                                						<div class="col-sm-3 col-lg-5 widget-left">
                                                						<span style="font-size: 40px;"class="glyphicon glyphicon-warning-sign"></span>
                                                						</div>
                                                						<div class="col-sm-9 col-lg-7 widget-right">
                                                							<div class="large">{{$sanctionedAthletes}}</div>
                                                							<div class="text-muted">Sanctioned Athletes</div>
                                                						</div>
                                                					</div>
                                                				</div>
                                                				</a>
                                                				</div>
                                                				<div class="col-md-5 col-sm-offset-1">
                                                				<div class="panel panel-blue panel-widget">
                                                                     					<div class="row no-padding">
                                                                     						<div class="col-sm-3 col-lg-5 widget-left">
                                                                     							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
                                                                     						</div>
                                                                     						<div class="col-sm-9 col-lg-7 widget-right">
                                                                     							<div class="large">{{$homeViewCount}}</div>
                                                                     							<div class="text-muted">Page Views</div>
                                                                     						</div>
                                                                     					</div>
                                                                     				</div>
                                                                     			</div>
                                                                     			</div>
                                                                     			</div>
                                                                     			<div class="row">
                                                                     			<div class="col-sm-5 col-sm-offset-1">
                                                                     			<div class="panel panel-orange panel-widget">
                                                                                                                                                     					<div class="row no-padding">
                                                                                                                                                     						<div class="col-sm-3 col-lg-5 widget-left">
                                                                                                                                                     							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
                                                                                                                                                     						</div>
                                                                                                                                                     						<div class="col-sm-9 col-lg-7 widget-right">
                                                                                                                                                     							<div class="large">{{$applicantCount}}</div>
                                                                                                                                                     							<div class="text-muted">Applicants</div>
                                                                                                                                                     						</div>
                                                                                                                                                     					</div>
                                                                                                                                                     				</div>
                                                                     			</div>
                                                                     				<div class="col-sm-5 col-sm-offset-1">
                                                                                                                                                     			<div class="panel panel-teal panel-widget">
                                                                                                                                                                                                                                     					<div class="row no-padding">
                                                                                                                                                                                                                                     						<div class="col-sm-3 col-lg-5 widget-left">
                                                                                                                                                                                                                                     						    <h1><span style="color:white;position: relative;top:-10px;" class="glyphicon glyphicon-envelope"></span></h1>
                                                                                                                                                                                                                                     								</div>
                                                                                                                                                                                                                                     						<div class="col-sm-9 col-lg-7 widget-right">
                                                                                                                                                                                                                                     							<div class="large">{{$applicantCount}}</div>
                                                                                                                                                                                                                                     							<div class="text-muted">Contact Messages</div>
                                                                                                                                                                                                                                     						</div>
                                                                                                                                                                                                                                     					</div>
                                                                                                                                                                                                                                     				</div>
                                                                                                                                                     			</div>
                                                                     			</div>

@stop