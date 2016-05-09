@extends('athlete')
@section('css')
<link href='/addons/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
<link href='/addons/fullcalendar-2.6.1/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='/addons/fullcalendar-2.6.1/lib/moment.min.js'></script>
<script src='/addons/fullcalendar-2.6.1/lib/jquery.min.js'></script>
<script src='/addons/fullcalendar-2.6.1/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {


		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: $.now(),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
			    @foreach($listOfSchedule as $sched)
			        {
			         title:'{{$sched->title}}',
			         start:'{{$sched->date_of}}T{{$sched->time_of}}',
			         @if($sched->type=='Training')<?php $back='#cd5129';?> @else <?php $back='#2b579a';?> @endif
			         backgroundColor:'{{$back}}',
                     url:'/OAMS/coach/UpdateSchedule/{{$sched->id}}'
			        },
			    @endforeach
							]
		});

	});

</script>
<style>
    .view{
    padding:0 -20px;
    }
	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
	.f h5,a{
	    margin-top: -10px;
	}
	.footer{
    	 background-color: #005599;
    	 position: relative;
    	 height: 50px;
    	 width: 100%;
    	 bottom: 0;
    	 left:0;
    	}
    @if($view=="calendar")
        .c{
            color:blue;
        }
     @else
        .l{
            color: blue;
        }
    @endif

</style>

@stop
@section('contents')
<div class="container-fluid">
<div class="row view">

    <div class="col-sm-2 well f" style="height: 60px;"><h5>View Type:</h5><a href="/OAMS/athlete/list/1"><span class="glyphicon glyphicon-tasks l" title="List View"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{route('athleteSchedule')}}" title="Calendar View"><span class="glyphicon glyphicon-calendar c"></span></a></div>

</div>
<div class="row">
@if($view=='calendar')
<div id='calendar'></div>


@else
       <table class="table table-bordered">
                <tr class="success"><th>Title</th><th>Venue</th><th>Date</th><th>Time</th><th>Type</th><th>Team Type</th></tr>
                @foreach($listOfSchedule as $sched)
                    <tr><td>{{$sched->title}}</td><td>{{$sched->venue}}</td><td>{{$sched->date_of}}</td><td>{{$sched->time_of}}</td><td>{{$sched->type}}</td><td>{{$sched->teamType}}</td></tr>
                @endforeach
       </table>
</div>
<div class="row">
   <center>
    @for($x=0;$x<=($pageCount/8);$x++)
    <a href="/OAMS/athlete/list/{{$x+1}}"><div class="btn btn-primary" @if($x+1==$page)style="color: #0088bb;"@endif>{{$x+1}}</div></a>
    @endfor
    </center>
</div>
<div class="row well co">
<center>
    <h4>{{$pageCount}} schedules are set and{{$noOfUpcoming}} of them is/are upcoming.</h4>
    </center>

 </div>
@endif

<footer class="footer">dasdas</footer>
</div>
</div>
@stop