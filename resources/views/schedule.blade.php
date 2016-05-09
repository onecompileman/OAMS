@extends('coach')
@section('css')
<link href='/addons/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
<link href='/addons/fullcalendar-2.6.1/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='/addons/fullcalendar-2.6.1/lib/moment.min.js'></script>
<script src='/addons/fullcalendar-2.6.1/lib/jquery.min.js'></script>
<script src='/addons/fullcalendar-2.6.1/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {
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
               },1000);

	    $('.menu').children('li').removeClass('active');
          document.getElementsByClassName('menu')[0].getElementsByTagName('li')[1].className='active';

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},

			defaultDate: $.now(),
			editable: false,
			eventLimit: false, // allow "more" link when too many events
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
.fc-time-grid .fc-slats td {
    height: 3.5em;
}
    .view{
           background-color: white;
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

    <div class="col-sm-2 well f" style="height: 60px;"><h5>View Type:</h5><a href="/OAMS/coach/Schedule/list/1"><span class="glyphicon glyphicon-tasks l" title="List View"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{route('viewCalendarSchedule')}}" title="Calendar View"><span class="glyphicon glyphicon-calendar c"></span></a></div>
<div class="col-sm-2 well f" style="height: 60px;"><h5>Legend:</h5><span class="glyphicon glyphicon-stop" style="color:#2b579a;"></span><a style="text-decoration: none;">&nbsp;&nbsp;Game</a><span class="glyphicon glyphicon-stop" style="color:#cd5129;"></span><a style="text-decoration: none;">&nbsp;&nbsp;Training</a></div>

</div>
<div class="row view">
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
    <a href="/OAMS/coach/Schedule/list/{{$x+1}}"><div class="btn btn-primary" @if($x+1==$page)style="color: #0088bb;"@endif>{{$x+1}}</div></a>
    @endfor
    </center>
</div>
<div class="row well co">
<center>
    <h4>{{$pageCount}} schedules are set and{{$noOfUpcoming}} of them is/are upcoming.</h4>
    </center>

 </div>
@endif
<div class="row">
<div class="col-offset-7 col-sm-11">
<center><a href="{{route('addSchedule')}}"><div class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span>Add Schedule</div></a></center>
</div>
</div>
</div>
@stop
