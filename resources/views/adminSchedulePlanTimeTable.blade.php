@extends('staff')
@section('css')
<meta charset="utf-8"/>
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">


   <link href='/addons/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
               <link href='/addons/fullcalendar-2.6.1/fullcalendar.print.css' rel='stylesheet' media='print' />
               <script src='/addons/fullcalendar-2.6.1/lib/moment.min.js'></script>
               <script src='/addons/fullcalendar-2.6.1/lib/jquery.min.js'></script>
               <script src='/addons/fullcalendar-2.6.1/fullcalendar.min.js'></script>
<script src="/addons/js/bootstrap.js"></script>
    <script>
            function disableAllFc(){
                $('.fc-time-grid-event').hide();
            }

         	$(document).ready(function() {
                     	                var left='85%';
         	 $('.toggle').click(function(){
                            $('.legend').css('left',left);
                             left =(left == '85%')? '100%':'85%';
                        });
            $('#vLegend').click(function(){
                   $('.legend').css('left',left);
                                             left =(left == '85%')? '100%':'85%';
            });

            $('#s').keyup(function(){
               $('#legend').children('tbody:first-child').children('tr').hide();
               $('#legend').children('tbody:first-child').children('tr:contains('+$(this).val()+')').show();
            });
         	$('.nav').children('li').removeClass('active');
         	$('.nav').children('li:nth-child(3)').addClass('active');
         	$('[data-toggle="popover"]').popover();
         	$('#venues').change(function(){
         	      disableAllFc();
         	      $('.fc-time-grid-event:contains("'+$(this).val()+'")').show();
         	});
         	$('#search').keyup(function(){
         	       disableAllFc();
                         	      $('.fc-time-grid-event:contains("'+$(this).val()+'")').show();

         	});
                var ndxs = [1,2,3,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26];
         			$('#calendar').fullCalendar({
                			header: {
                				right: 'agendaWeek'
                			},
                            /*
                            * 10 -16
                            * */
                			defaultDate: '2016-01-12',
                			editable: false,
                			eventLimit: true, // allow "more" link when too many events
                			events: [
                			<?php $st = ['s ','m ','t ','w ','th ','f ','st '];
                                        			       $d=[10,11,12,13,14,15,16];
                                        			?>
                                        			@if(count($schedule)> 0)
                                                         			@foreach($schedule as $sched)
                                                         			    @for($x=0;$x<count($st);$x++)
                                                         					@if(strpos($sched->days,$st[$x]) > 0)
                                                         					{
                                                         					title: '{{$sched->team_name}}\n{{$sched->venue_name}}',
                                                         					start: '2016-01-{{$d[$x]}}T{{$sched->timeRangeFrom}}',
                                                         					end: '2016-01-{{$d[$x]}}T{{$sched->timeRangeTo}}',
                                                         					backgroundColor:$('#legend').children('tbody').children('tr:nth-child('+(ndxs.indexOf({{$sched->id}})+1)+')').children('td:first-child').css('color')
                                                         					},
                                                                            @endif
                                                         				@endfor
                                                         				@endforeach
                                                         				@endif

                			]
                		});
         		$('.fc-right').children('button').click();
                 var dayAb = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                 var day = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                 $('.fc-day-header').each(function(){
                    $(this).html(day[dayAb.indexOf($(this).html().toString().split(' ')[0])]);
                 });

         	});
             setInterval(function(){
                 $('.fc-scroller').scrollTop(264).css('height','700px').css('overflow-y','hidden');
             },0);
         </script>
     <style>
     .fc-time-grid-event{
      text-align: center;
     }
     .toggle{
        cursor: pointer;
     }
     body::-webkit-scrollbar{
        background-color: #0b2644;
        width: 5px;
        height: 5px;
     }
     body::-webkit-scroll-thumb{
        background-color: #4cd8d8;
     }
     .legend{
        transition: 0.5s linear;
     }
     body{
     overflow-x: scroll;
     }
     .fc-view-container{
             height: 800px;
             overflow-y: hidden;
             top:264px;
         }

     	#calendar {
     		max-width: 1300px;
     	}
         .fc-left h2{
             display: none;
         }
         .fc-right button{
             display: none;
         }
         .fc-day-grid{
             display: none;
         }
         .fc-slats tr:nth-child(1){        opacity: 0;    }
         .fc-slats tr:nth-child(2){       opacity: 0;    }
         .fc-slats tr:nth-child(3){        opacity: 0;    }
         .fc-slats tr:nth-child(4){        opacity: 0;    }
         .fc-slats tr:nth-child(5){       opacity: 0;   }
         .fc-slats tr:nth-child(6){       opacity: 0;    }
         .fc-slats tr:nth-child(7){        opacity: 0;    }
         .fc-slats tr:nth-child(8){       opacity: 0;    }
         .fc-slats tr:nth-child(9){        opacity: 0;    }
         .fc-slats tr:nth-child(10){       opacity: 0;;    }
         .fc-slats tr:nth-child(11){       opacity: 0;    }
         .fc-slats tr:nth-child(12){       opacity: 0;    }
         .fc-slats tr:nth-child(48){        opacity: 0;    }
         .fc-slats tr:nth-child(47){        opacity: 0;;    }
         .fc-slats tr:nth-child(46){       opacity: 0;    }
         .fc-slats tr:nth-child(45){       opacity: 0;   }
         .fc-slats tr:nth-child(44){        opacity: 0;    }
         .fc-scroller::-webkit-scrollbar{
             background-color: #003f54;
             width: 5px;
         }
         .fc-scroller::-webkit-scrollbar-thumb{
             background-color:#22cff6 ;
         }
         .fc-axis{
             font-weight: bold;
         }
         .fc-day-header{
             position: relative;
             font-size: 18px;
             padding-top: 5px;
             padding-bottom: 5px;
           background-color:#0b2644;
             color: white;
         }
         #legend tbody tr {
             transition: 0.5s linear;
             cursor: pointer;
         }
         #legend tbody tr:hover{
             background-color: #4cd8d8;
         }
         #legend tbody tr:hover td:nth-child(2){
         color: #ffffff;
         }
         #leg::-webkit-scrollbar{
             background-color: #0b2644;
             width: 5px;
         }
         #leg::-webkit-scrollbar-thumb{
             background-color: #22cff6;
         }
         table tr td h6{
            color:white;
         }
     </style>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->

<div class="row" style="width: 100%;">
            <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
                <center><h3 style="color: #ffffff;"><b>S C H E D U L E</b></h3></center>
            </div>
        </div>
          <br/>
                        <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back schedule" onload="$(this).popover()"><a href="{{route('adminSchedule')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Training Schedule TimeTable</u> </h5>
                <br/>
                @if(count($schedule)>0)
    <div class="row">

<div class="col-sm-2" style="display: none;position: relative;" >
    <br/><br/><br/><br/><br/>

</div>
<div class="col-sm-10" style="width: 105%;position: absolute;top:150px;left:-3%;">

            <div class="row panel" style="margin-left: 0.5%;">
             <center>         &nbsp;&nbsp;&nbsp;
            <h1 style="color: #0b2644;display: inline; "><b>W E E K L Y &nbsp;&nbsp; T I M E T A B L E</b></h1>
              <h3>Season {{$sch[0]->season}} A.Y. {{date_format(date_create($sch[0]->startDate),'Y')}} -  {{(intval(date_format(date_create($sch[0]->startDate),'Y')) + 1)}}</h3></center>
                        <hr style="border: 2px solid #1a182f;"/>

            <div class="col-sm-2"><div title="" data-toggle="popover" data-trigger="hover" data-content="View Team and Color Legend" style=" display: inline;" >   <button type="button" class="btn btn-info btn-sm" id="vLegend" style="background-color:#0b2644;"><b><span class="glyphicon glyphicon-eye-open"></span></b> &nbsp;View Legend</button></div></div>
            <div class="col-sm-4"><b>View by venue: </b><select id="venues" class="btn btn-primary" style="background-color: #0b2644;"><option value="">View All Venue</option>@foreach($venueList as $venue)<option value="{{$venue->venue_name}}">{{$venue->venue_name}}</option>@endforeach</select></div>
            <div class="col-sm-3">
            <div class="input-group">
              <input type="search" id="search" class="form-control" placeholder="Type to search" aria-describedby="basic-addon1">
                            <span class="input-group-addon btn btn-info" id="basic-addon1" style="background-color: #5bc0de;"><span class="glyphicon glyphicon-search"></span></span>
            </div>
            </div>
            <br/>
            <div id='calendar'></div>
            </div>
</div>
    </div>
    <div class="legend" style="background-color: rgba(0,0,0,0.85);position: fixed;left:100%;height: 510px;z-index:100;">
    <div class="toggle" style="background-color: black;width: 50px;height: 50px;border-radius: 20px 0px 0px 20px;position: relative;left: -25%;z-index:120;"></div>
        <br/>
        <center>
                                    <h5 style="position: relative; top: -10px;color:white;">T E A M &nbsp;L E G E N D</h5>
                                </center>
                                <hr style="position: relative;top:-10px;"/>
                             <center>   <h5 style="display: inline;color:white;"><b>COLOR</b></h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 style="display: inline;color:white;"><b>TEAM</b></h5></center>
                                <input type="search" id="s" placeholder="Type to search" class="form-control"/>

                                <div id="leg" style="height: 300px;overflow-y:scroll; ">
                                <table id="legend" class="table table-responsive" style="background-color: inherit;color:white;">
                                    <tbody>
                                    <tr>
                                        <td style="font-size: 40px; color:#22cff6;"><center>■</center></td>
                                        <td><h6><center><b>NU Bulldogs</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#00f33b;"><center>■</center></td>
                                        <td><h6><center><b>NU Lady Bulldogs</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#1a4d6e;"><center>■</center></td>
                                        <td><h6><center><b>NU Bullpups</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#3c3f41;"><center>■</center></td>
                                        <td><h6><center><b>NU Junior Spikers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#2e08a6;"><center>■</center></td>
                                        <td><h6><center><b>NU Booters</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#0080ff;"><center>■</center></td>
                                        <td><h6><center><b>NU Batters</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#ff80ff;"><center>■</center></td>
                                        <td><h6><center><b>NU SoftBelles</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#ff8040;"><center>■</center></td>
                                        <td><h6><center><b>NU Jins</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#ff0000;"><center>■</center></td>
                                        <td><h6><center><b>NU Lady Jins</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#00ffff;"><center>■</center></td>
                                        <td><h6><center><b>NU Junior Jins</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#ff0080;"><center>■</center></td>
                                        <td><h6><center><b>NU Fencers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#8f0e8f;"><center>■</center></td>
                                        <td><h6><center><b>NU Shuttlers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#ffff00;"><center>■</center></td>
                                        <td><h6><center><b>NU Lady Shuttlers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#8080ff;"><center>■</center></td>
                                        <td><h6><center><b>NU Junior Shuttlers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#8f0e0e;"><center>■</center></td>
                                        <td><h6><center><b>NU Tennisters</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#0e8f0e;"><center>■</center></td>
                                        <td><h6><center><b>NU Lady Tennisters</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#000068;"><center>■</center></td>
                                        <td><h6><center><b>NU Junior Tennisters</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#8f008f;"><center>■</center></td>
                                        <td><h6><center><b>NU Paddlers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#64544e;"><center>■</center></td>
                                        <td><h6><center><b>NU Junior Paddlers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#084d64;"><center>■</center></td>
                                        <td><h6><center><b>NU Woodpushers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#400040;"><center>■</center></td>
                                        <td><h6><center><b>NU Lady Woodpushers</b></center></h6></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 40px; color:#804000;"><center>■</center></td>
                                        <td><h6><center><b>NU Junior Woodpushers</b></center></h6></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
    </div>
@else
<div id="no">
    <center><h1 style="font-size: 80px;"><span class="glyphicon glyphicon-ban-circle"></span></h1></center>
    <center><h2>No such schedule exists!</h2></center>
</div>
@endif

@stop