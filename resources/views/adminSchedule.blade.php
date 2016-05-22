@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">

<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
     <script src="/addons/js/bootstrap.js"></script>
<script>
    	$(document).ready(function() {
            $('.nav').children('li:nth-child(3)').addClass('active');
    		$('#calendar').fullCalendar({
    		    header:{
    		     center:"title",
    		     left:''
    		    },
    			defaultDate: "{{date('Y-m-d')}}",
    			editable: true,
    			eventLimit: true, // allow "more" link when too many events
    			events: [
    				{
    					title: 'All Day Event',
    					start: '2016-01-01'
    				}

    			]
    		});
    			$('#calendars').fullCalendar({
                		    header:{
                		     center:"title",
                		     left:''
                		    },
                			defaultDate: "{{date('Y-m-d')}}",
                			editable: true,
                			eventLimit: true, // allow "more" link when too many events
                			events: [
                				{
                					title: 'All Day Event',
                					start: '2016-01-01'
                				}

                			]
                		});
                		$('#gameCalendar').toggle();
                		$('#prev,#next').click(function(){
                		    $('#trainingCalendar').toggle();
                		    $('#gameCalendar').toggle();
                		});
    		$('.switch').click(function(){
                    $(this).children('.switch-thumb').css('float',(($(this).children('.switch-thumb').css('float').toString() ==  'left')? 'right':'left'));
    		         if($(this).children('.switch-thumb').css('float').toString() == 'left'){
    		                $('#high').css('color','#4cd8d8');
    		                $('#coll').css('color','#686d70');
    		            }
    		         else{
    		                $('#high').css('color','#686d70');
                            $('#coll').css('color','#4cd8d8');
    		         }
    		});
    		var dayAb = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    		var dayFull = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    		setInterval(function(){
    		      $('.fc-day-header').each(function(){
                                          		       $(this).html(dayFull[dayAb.indexOf($(this).html().toString())]);
                                          		      }).parent('tr').css({"background-color":'#20203f',"color":"white",'font-weight':'bold','font-size':'18    px'});
    		},0);
    	});
    	function toggleT(){
    	    $('#high').css('color',(($('#high').css('color').toString() == '#4cd8d8')? '#686d70':'#4cd8d8'));
    	    $('#coll').css('color',(($('#coll').css('color').toString() == '#4cd8d8')? '#686d70':'#4cd8d8'));
    	}
</script>
<style>
    #prev{
        transition: 0.5s linear;
    }
    #next{
        transition: 0.5s linear;
    }
    #next:hover{
        transform: scale(1.1);
        color: #3498db;
    } #prev:hover{
        transform: scale(1.1);
        color: #3498db;
    }
    .switch{
        background-color: #5bc0de;
        border-radius: 15px;
        height: 30px;
        padding: 2px;
        width: 70px;
        cursor: pointer;
        transition: 0.2s linear;
    }
    .switch:hover{
        background-color: #0080ff;
    }
    .switch-thumb{
        background-color: #ffffff;
        position: relative;
        width: 30px;
        height: 26px;
        border-radius: 120%;
        float: left;
        box-shadow: 0 0 1px 1px rgba(0,0,0,0.2);
        transition: 0.2s linear;
    }
    #high{
        color:#4cd8d8;
        transition: 0.2s linear;
    }
    #coll{
    transition:0.2s linear ;
    }
</style>
@stop
@section('contents')
    <div class="row">
            <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
                <center><h3 style="color: #ffffff;"><b>S C H E D U L E</b></h3></center>
            </div>
        </div>
        <br/>
        <div class="row panel" style="box-shadow: 0 0 3px 3px rgba(0,0,0,0.2);padding:30px;">
        <div>
            <div class="btn btn-info" style="background-color: #0b2644;"> <a href="{{route('adminVenue')}}" style="color:white;"><b><span class="glyphicon glyphicon-plus-sign" ></span></b>&nbsp; Training Venue</a></div>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="btn btn-info"  style="background-color: #0b2644;"> <a href="{{route('adminGameVenue')}}" style="color:white;"><b><span class="glyphicon glyphicon-plus-sign" ></span></b>&nbsp; Game Venue</a></div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="btn btn-primary"  style="background-color: #0b2644;"><a href="{{route('adminTrainingSchedule')}}" style="color:white;"><b><span class="glyphicon glyphicon-calendar" ></span></b>&nbsp; Set Training Schedule</a></div>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="btn btn-success"  style="background-color: #0b2644;"><a href="{{route('adminViewGameSchedule')}}" style="color: #ffffff;"><b><span class="glyphicon glyphicon-th" ></span></b>&nbsp; Set Game Schedule</a></div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="btn btn-warning"  style="background-color: #0b2644;"><b><span class="glyphicon glyphicon-eye-open" ></span></b>&nbsp; View Athlete's Attendance</div>
        </div>
            <hr style="border: 2px solid #0b2644;"/>
            <div class="col-sm-12" style="position:relative;" id="trainingCalendar">
                   <center><h2><span id="prev" class="glyphicon glyphicon-chevron-left" style="cursor:pointer;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><span class="glyphicon glyphicon-calendar" style="color:#3498db;"></span></b>&nbsp;Traning Calendar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="next" class="glyphicon glyphicon-chevron-right" style="cursor: pointer;"></span></h2></center>
                 <hr style="border:1px solid #ffffff;box-shadow: 0 0 1px 1px rgba(0,0,0,0.2);"/>
                 <br/>
                 <div class="row">
                    <div class="col-sm-3"><b>View by venue: </b><select class="btn btn-info" name="" id="venues" style="background-color: #0b2644;"><option value="">All Venues</option></select></div>
                    <div class="col-sm-3"><b>View by team: </b><select class="btn btn-primary" name="" id="teams" style="background-color: #0b2644;"><option value="">All Teams</option></select></div>
                    <div class="col-sm-4"><b id="high">HighSchool Team</b>  <div class="switch" style="display: inline-block;background-color: #0b2644;"><div class="switch-thumb"></div></div> <b id="coll">College Team</b></div>
                 </div>
                 <br/>
                 <hr/>
                 <div id="calendar"></div>
            <br/>
            </div>
             <div class="col-sm-12" style="position:relative;" id="gameCalendar">
                               <center><h2><span id="prev" class="glyphicon glyphicon-chevron-left" style="cursor:pointer;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><span class="glyphicon glyphicon-calendar" style="color:#3498db;"></span></b>&nbsp;Game Calendar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="next" class="glyphicon glyphicon-chevron-right" style="cursor: pointer;"></span></h2></center>
                             <hr style="border:1px solid #ffffff;box-shadow: 0 0 1px 1px rgba(0,0,0,0.2);"/>
                             <br/>
                             <div class="row">
                                <div class="col-sm-3"><b>View by team: </b><select class="btn btn-primary" name="" id="teams" style="background-color: #0b2644;"><option value="">All Teams</option></select></div>
                                <div class="col-sm-4"><b id="high">HighSchool Team</b>  <div class="switch" style="display: inline-block;background-color: #0b2644;"><div class="switch-thumb"></div></div> <b id="coll">College Team</b></div>
                             </div>
                             <br/>
                             <hr/>
                             <div id="calendars"></div>
                        <br/>
                        </div>
        </div>
@stop