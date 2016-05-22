@extends('staff')
@section('css')
    <script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
         <script src="/addons/js/bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.nav').children('li').removeClass('active');
        $('.nav').children('li:nth-child(3)').addClass('active');
        $('[data-toggle="popover"]').popover();
    });
</script>
<style>
    #publishCon::-webkit-scrollbar{
        background-color: #1a4d6e;
        width: 5px;
    }#publishCon::-webkit-scrollbar-thumb{
             background-color: #22cff6;
         }

    .ban{
        transition: 0.5s linear;
    }
    .ban:hover{
        color:red;
        transform: scale(1.1);
    }
    .day{
        transition: 0.5s linear;
        cursor: pointer;
        border-radius: 3px;
        padding: 3px;
        font-weight: bold;
        font-size: 12px;
    }
    .day:hover{
        color: white;
        background-color: #0b2644;
    }
    #info h5{
     display: inline;
    }
</style>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->
            <div id="publish" class="modal fade" role="dialog">
              <div class="modal-dialog" style="width: 100%;">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title" style="color:#3498db;"><b><span class="glyphicon glyphicon-question-sign"></span></b>&nbsp;C O N F I R M A T I O N</h4></center>
                  </div>
                  <div class="modal-body">
                  <div class="container-fluid">
                   <div class="row">
                   <div class="col-sm-12">
                           <center> <h4 style="color:red;"><b><span class="glyphicon glyphicon-warning-sign"></span></b>&nbsp; Warning</h4></center>
                            <center><p>Publishing a schedule plan will result to appending all the planned days and time range of training for all allocated teams in the Athletic's calendar, make sure that necessary teams and right information is properly allocated, this maybe deleted but can't be edited, due to some concerns..</p></center>
                   </div>
                   </div>
                   <hr/>
                   <div class="row">
                        <center><h4><b><span class="glyphicon glyphicon-info-sign"></span></b>&nbsp;&nbsp;Schedule Plan Information</h4></center>
                   </div>
                   <div id="prog">

                   </div>
                   <hr/>
                   <div id="info" class="row">
                   <div class="col-sm-5 col-sm-offset-1" style="display: inline;"><h5><b>Season :</b></h5><h5 class="season" style="display: inline;"></h5></div>
                   <div class="col-sm-5"><h5><b>Semester :</b></h5><h5 class="semester"></h5></div>
                   <br/>
                   <div class="col-sm-5 col-sm-offset-1"><h5><b>Start Date :</b></h5><h5 class="start"></h5></div>
                   <div class="col-sm-5"><h5><b>End Date :</b></h5><h5 class="end"></h5></div>
                   <div class="count" style="display: none;"></div>
                   </div><br/>
                   <div id="publishCon" class="row" style="height: 250px;overflow-y: scroll;">

                   </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                  <form action="{{route('adminPublishSchedule')}}" id="formpublish" method="post">
                     <input type="hidden" id="pId" name="id"/>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp;Cancel</button>
                    <button class="btn btn-info" id="publishBtn" ><b><span class="glyphicon glyphicon-book"></span></b>&nbsp; Publish</button>
                 </form>
                  </div>
                </div>

              </div>
            </div>
  <div id="venues" class="modal fade" role="dialog">
                    <br/><br/><br/><br/>
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="closes close" data-dismiss="modal">&times;</button>
                   <center><h4 class="modal-title" style="color:#3498db;"><b><span class="glyphicon glyphicon-globe"></span></b>&nbsp; T R A I N I N G &nbsp; V E N U E</h4></center>
                  </div>
                   <form class="form-group" action="" id="formVenue" method="post" name="formvenue">
                  <div class="modal-body con">
                        <br/><br/><input class="form-control" type="text" name="venue_name" placeholder="Venue Name" maxlength="255" aria-required="true"/>
                            <div style="color:red;" id="comm"></div>
                        <br/>

                         <input class="form-control" type="text" name="address" placeholder="Venue Address" maxlength="255" aria-required="true" />
                         <div id="comm2" style="color: red;"></div>
                         <br/><input class="form-control" type="number" name="playerLimit" placeholder="Player Limit" max="200" min="20" aria-required="true"/><br/><br/>

                  </div>
                  <div class="modal-footer">
                   <button type="reset" class="btn btn-warning"><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp;Reset</button>
                    <button class="btn btn-info" id="addV"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp;Add</button>
                  </div>
                   </form>
                </div>

              </div>
            </div>
<!-- Trigger the modal with a button -->

            <!-- Modal -->
            <div id="addSchedule" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <br/><br/><br/><br/><br/>
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title" style="color:#3498db;">S C H E D U L E &nbsp; P L A N</h4></center>
                  </div>
                    <form class="form-group" action="" method="post" id="scheduleplan">
                  <div class="modal-body">
                  <div class="row">
                  <br/><br/>
                  <div class="col-sm-10 col-sm-offset-1 ">
                                                       <div class="row"><div class="col-sm-6">
                                                       <input type="hidden" id="pid" name="id"/>
                                                                                                                    <input type="number" class="form-control" placeholder="Season" name="season" id="sea"/>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-6"><select class="form-control" name="semester" id="sem"><option value="both">1st and 2nd
                                                                        Sem</option><option value="1st">1st Sem</option><option value="2nd">2nd Sem</option></select></div>
<br/><br/><br/>
                                                                                                                                                        <div class="col-sm-12 well">
                                                                                                                                                                  <div class="row">
                                                                                                                                                                   <center><h4><b><span class="glyphicon glyphicon-th" style="color: #3498db;"></span>&nbsp; Date Range</b></h4></center>
                                                                                                                                                                    <hr/>

                                                                                                                                                                            <div class="col-sm-5 col-sm-offset-1">
                                                                                                                                                                            <label for="sd">From: </label>
                                                                                                                                                                           <input type="date" class="form-control" name="startDate" id="sd" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}"/>
                                                                                                                                                                           </div>
                                                                                                                                                                           <div class="col-sm-5">
                                                                                                                                                                            <label for="ed">To: </label>  <?php $date =  date_create(strval(date('Y-m-d'))); date_add($date,date_interval_create_from_date_string("4 months"));  ?>
                                                                                                                                                                           <input type="date" class="form-control" name="endDate" id="ed" min="{{date_format($date,'Y-m-d')}}" value="{{date_format($date,'Y-m-d')}}"/>
                                                                                                                                                                           </div>
                                                                                                                                                                       <br/>
                                                                                                                                                                        </div>
                                                                                                                                                                        <br/>
                                                                                                                                                     </div>

                                                                                                                                                   </div>
                  </div>
                  </div>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-warning" id="sreset"><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp; Reset</button>
                    <button class="btn btn-info" id="sadd"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add</button>
                    <button class="btn btn-danger" id="sdelete" data-toggle="modal" data-target="#confirm"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                    <button class="btn btn-primary" id="supdate" ><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Update</button>
                  </div>
                  </form>
                </div>

              </div>
            </div>
            <!-- Trigger the modal with a button -->

                        <!-- Modal -->
                        <div id="confirm" class="modal fade" role="dialog">
                        <br/><br/><br/><br/><br/><br/>
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <center><h4 class="modal-title" style="color: #3498db;"><b><span class="glyphicon glyphicon-question-sign"></span></b>&nbsp;C O N F I R M A T I O N</h4></center>
                              </div>
                              <form action="" method="post">
                              <div class="modal-body">
                                    <br/>
                                   <center><h5><b>Are you sure to delete this schedule plan? </b></h5></center>
                                    <br/>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp;Cancel</button>
                                <button class="btn btn-danger" type="submit"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                              </div>
                              </form>
                            </div>

                          </div>
                        </div>
<div class="row">
            <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
                <center><h3 style="color: #ffffff;"><b>S C H E D U L E</b></h3></center>
            </div>
        </div>
          <br/>
                        <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back schedule" onload="$(this).popover()"><a href="{{route('adminSchedule')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Training Schedule</u> </h5>
                <br/>
                <div id="alert">
                   @if(Session::has('success')))
                    <div class="alert bg-success">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <b>{{Session::get('success')}}</b>
                    </div>

                   @endif
                </div>

                <div class="row">
                    <br/>
                        <div class="col-sm-4 well" style="position: relative;margin-left: 2%;background-color: white;">
                        <div class="row">
                            <center><h4 style="position: relative; top: -15px;"><b><span class="glyphicon glyphicon-calendar" style="color:#3498db;"></span></b>&nbsp;&nbsp;&nbsp;Schedule Plan</h4></center>
                            <hr style="border: 1px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);position: relative;top: -20px;"/>
                           <center><div class="btn btn-info" style="position: relative;top:-18px;background-color: #0b2644;" id="setNew" data-toggle="modal" data-target="#addSchedule"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp;&nbsp;Set New Schedule</div></center>
                            @if(count($schedule) == 0)
                                <center><h5><b><span class="glyphicon glyphicon-ban-circle" style="color: red;"></span></b>&nbsp;&nbsp;No Schedule Set.</h5></center>
                            @else
                                @if(date_format(date_create($schedule[count($schedule) - 1]->endDate),'Y-m-d') < date('Y-m-d'))
                                  <center><h5><b><span class="glyphicon glyphicon-ban-circle" style="color: red;"></span></b>&nbsp;&nbsp;The current schedule plan has <elapsed class=""></elapsed></h5></center>
                                @endif
                            @endif
                            <br/>
                            <hr style="border:1px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);position: relative;top:-25px;"/>
                            <table id="scheduleList" class="table-hover" width="100%" cellspacing="0" style="position: relative;top:-25px;"><thead style="background-color: #0b2644;color:white;"><tr>
                                <th>ID</th>
                                <th>Season</th>
                                <th>Semester</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                </tr></thead>
                                 <tbody>
                                    @foreach($schedule as $s)
                                        <tr>
                                            <td>{{$s->id}}</td>
                                            <td>{{$s->season}}</td>
                                            <td><div>{{$s->semester}}</div>
                                                <div style="display: none;">{{$s->startDate}}</div><div style="display: none;">{{$s->endDate}}</div>
                                            </td>
                                            @if($s->published)
                                            <td><div class="btn btn-danger"><span class="glyphicon glyphicon-trash" style="font-size: 10px;cursor: pointer;"></span></div></td><td><div class="btn btn-success" style="font-size: 10px;cursor: pointer;"><span class="glyphicon glyphicon-print"></span></div></td>
                                            @else
                                                                                        <td><div class="btn btn-info" style="cursor: pointer;font-size: 10px;" id="view" title="" data-toggle="popover" data-trigger="hover" data-content="View Schedule list and set schedule per team"><span class="glyphicon glyphicon-eye-open"></span></div></td><td><div class="btn btn-primary sched" style="font-size: 10px;cursor: pointer;" data-toggle="modal" data-target="#addSchedule"><span class="glyphicon glyphicon-edit" title="Edit Schedule Plan" data-toggle="popover" data-trigger="hover" data-content="" ></span></div></td><td><a  title="" data-toggle="popover" data-trigger="hover" data-content="Print Schedule Plan" target="_blank" href="/OAMS/admin/printSchedule/{{$s->id}}" class="btn btn-success" style="font-size: 10px;cursor: pointer;"><span class="glyphicon glyphicon-print"></span></a></td><td><div class="btn btn-warning publish" id="{{$s->id}}" data-toggle="modal" data-target="#publish" style="font-size: 10px;cursor: pointer;"><span title="Publish schedule to athletics calendar" data-toggle="popover" data-trigger="hover" data-content="" class="glyphicon glyphicon-book"></span></div></td>
                                            @endif
                                            </tr>
                                    @endforeach
                                 </tbody>
                                </table>
                        </div>
                                </div>
                                <div class="row" id="season">
                                <div class="col-sm-7 panel" style="position: relative;margin-right: 2%; margin-left: 2%;background-color: white;">
                                         <br/>
                                        <div class="row well" style="margin-right: 1.5%;margin-left: 1.5%;">

                                            <div id="tid" style="display: none;"></div>
                                                                                            <a class="btn btn-info" id="timetable" href="" target="_blank" title="" data-toggle="popover" data-trigger="hover" data-content="View schedule plan in timetable weekly layout."><b><span class="glyphicon glyphicon-th"></span></b></a>

                                            <div class="col-sm-5 col-sm-offset-1"><b>Season:</b>&nbsp;<h5 id="dsea" style="display: inline;"></h5></div>
                                            <div class="col-sm-5"><b>Semester:</b>&nbsp;<h5 id="dsem" style="display: inline;"></h5></div>
                                            <br/>
                                            <div class="col-sm-5 col-sm-offset-1"><b>Start Date:</b>&nbsp;<h5 id="dsd" style="display: inline;"></h5></div>
                                            <div class="col-sm-5"><b>End Date:</b>&nbsp;<h5 id="ded" style="display: inline;"></h5></div>
                                            <div class="col-sm-8 col-sm-offset-2">
                                            <br/>
                                                <h4 style="position:relative; display: inline;"><b>Team : </b></h4>
                                                <select name="team_id" id="team" class="btn btn-info" style="position: relative;display: inline; width: 80%;">@foreach($teamList as $team)<option value="{{$team->id}}">{{$team->team_name}}</option>@endforeach</select>  &nbsp;&nbsp;&nbsp; <div title="" data-toggle="popover" data-trigger="hover" data-content="Team names with (*) haven't set their schedules" style="position:relative;display: inline;"> <b><span class="glyphicon glyphicon-question-sign" style="color:#3498db;"></span></b></div>
                                                <br/><br/>
                                                </div>
                                        </div>
                                        <br/>
                                                                                                                            <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                        <div id="trainingCont">
                                          <form class="form-group" action="" method="post" name="trainingSched">

                                                                                <div class="row">
                                                                                    <center><h4><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; T R A I N I N G &nbsp; S C H E D U L
                                        E</h4></center>
                                                                                    <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                                                                    <br/><br/>
                                                                                    <div class="row">

                                                                                       <div class="col-sm-1 col-sm-offset-1">
                                                                                           <h5><b>Venue:</b></h5>
                                                                                           </div> <div class="col-sm-4"><select class="form-control" name="venue_id" id=""></select></div><div class="col-sm-2">
                                                                                               <h5><b>Team Type:</b></h5>
                                                                                               </div><div class="col-sm-2"><select class="form-control" name="team_type" id=""><option value="both">Team A and B</option><option value="Team A">Team A</option><option value="Team B">Team B</option></select></div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <br/><br/><br/>
                                                                                        <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                        <div class="row">
                                          <center><h4><b><span class="glyphicon glyphicon-cloud" style="color: #3498db;"></span>&nbsp; Days of Effect</b></h4></center>
                                                                                           <hr/>
                                                                                           <center>
                                                                                           <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="s " id="sun" name="days" />
                                        Sunday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="m " id="mon" name="days" />
                                        Monday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="t " id="tue" name="days" />
                                        Tuesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="w " id="wed" name="days"/>
                                        Wednesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="th " id="thur" name="days"/>
                                        Thursday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="f " id="fri" name="days" />
                                        Friday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="st " id="sat" name="days"/>
                                        Saturday</div>
                                                                                            </center>
                                                                                            <br/>
                                                                                        </div>
                                                                                        <br/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                    <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                    <div class="row">
                                                                                        <center>
                                                                                            <h4><b><span class="glyphicon glyphicon-time" style="color:#3498db;"></span>&nbsp;Time Range</b></h4>
                                                                                            </center>
                                                                                            <hr />
                                                                                            <div class="col-sm-4">
                                                                                            <label for="tf"  style="display: inline;">From: </label>
                                <input class="form-control" name="timeRangeFrom" type="time" id="tf" style="display: inline;" aria-required="true"/>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                              <label for="tt" style="display: inline;">To: </label>
                              <input class="form-control" name="timeRangeTo" type="time" id="tt" style="display: inline;" aria-required="true"/>
                                      </div>
                                   <br/>
                                </div>
                               <br/>
                                 </div></div></div>
                                  <br/>
                              <button type="reset" class="btn btn-warning" style="margin-left: 35%;" ><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp; Reset</button>
                                  <div class="btn btn-info" style="margin-left: 8%;"><b><span class="glyphicon glyphicon-question-sign"></span></b>&nbsp; Set Schedule</div>

                                 </form>
                                 </div>
                                </div>
                                </div>
                    <br/>
                </div>
                <script class="init">
                    $(document).ready(function(){

                        $.ajaxSetup({
                               	headers: {
                               		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               	        }
                               });
                        $('#scheduleList').DataTable({
                        "ordering":false,
                        "info":false
                        });
                        $('.publish').click(function(){
                                $('#pid').val($(this).parent('td').parent('tr').children('td:nth-child(1)').html());
                                $('.season').html($(this).parent('td').parent('tr').children('td:nth-child(2)').html());
                                $('.semester').html($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(1)').html());
                                $('.start').html($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(2)').html());
                                $('.end').html($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(3)').html());

                               $('#publishCon') .html('  <div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div><center><h5>Please Wait...</h5></center>');
                               $.post('{{route('adminGetSchedule')}}',{id:$(this).attr('id')},function(html){
                               $('#publishCon').html(html.toString().split('separate')[0]);
                               $('.count').html(html.toString().split('separate')[1]);
                                    $('#sch').DataTable();
                               });

                                 // $('#sch_length').hide();
                                     //                              $('#sch_filter').hide();
                        });
                        $('#publishBtn').click(function(e){
                        e.preventDefault();
                                if(parseInt($('.count').html()) <= 4){
                                    alert('Teams set must be 5 above');
                                }
                                else{
                                  if(confirm('Are You Sure?'))
                                     $('#formpublish').submit();
                                }
                        });
                        $('#addV').click(function(e){
                            e.preventDefault();
                            var venue_name= document.forms['formvenue']['venue_name'].value;
                            var address= document.forms['formvenue']['address'].value;
                            $('#comm').html('');
                            if($('#venue').html().toString().indexOf(venue_name.toString().trim())!=-1){
                                $('#comm').html('Venue name exists!');
                            }
                            else if(address == "")
                                $('#comm2').html("Address cant be blank");
                            else{

                            var playerLimit= document.forms['formvenue']['playerLimit'].value;
                            var data = {"venue_name":venue_name,"address":address,"playerLimit":playerLimit};
                            $.post('{{route('adminAAddVenue')}}',{data:data},function(html){
                                    $('#alert').html('<div class="alert alert-success" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'+html.toString().split('separate')[0]+'</b></div>');
                                    var opt ='';
                                    var playerSize ='';
                                    for(var x=0;x<((html.toString().split('separate')[1].split('/')).length);x++){
                                        opt += '<option value="'+(x+1)+'">'+(html.toString().split('separate')[1].split('/'))[x].split('*')[0]+'</option>';
                                        playerSize += '<h1>'+(html.toString().split('separate')[1].split('/'))[x].split('*')[1]+'</h1>';
                                    }
                                    $('#venue').html(opt);
                                    $('#vcount').html(playerSize);
                                    $('.closes').click();
                            });
                            }
                        });
                        $('#setNew').click(function(){
                            $('#sadd').show();
                            $('#sreset').show().click();
                            $('#supdate').hide();
                            $('#sdelete').hide();
                            $('#scheduleplan').attr('action','{{route('adminAddSchedule')}}');
                        });
                        $('#season').hide();

                        $('#view').click(function(){
                            $('#season').show();
                                                            $('#timetable').attr('href','/OAMS/admin/viewScheduleTimetable/'+$(this).parent('td').parent('tr').children('td:nth-child(1)').html());

                            $('#trainingCont').html('  <div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div><center><h5>Please Wait...</h5></center>');
                            $.post('{{route('adminViewSTraining')}}',{id:$(this).parent('td').parent('tr').children('td:nth-child(1)').html(),team_id:$('#team').val()},function(html){
                                $('#trainingCont').html(html);
                                var ndx = 1;
                                $('#not').children('h1').each(function(){
                                 var con;
                                    if($('#team').children('option:nth-child('+ndx+')').html().toString().indexOf('span')!=-1)
                                         con = $('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0];
                                        else con = $('#team').children('option:nth-child('+ndx+')').html();
                                   if($(this).html().toString() == "No")
                                       $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="No schedule has been set" >'+con+'<span style="color:red;font-size: 18px;">*</span></b>');
                                    else
                                       $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="Update schedule" >'+$('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0]+'</b>');
                                        ndx++;
                                });

                            });

                            $('#tid').html($(this).parent('td').parent('tr').children('td:nth-child(1)').html());
                            $('#dsea').html($(this).parent('td').parent('tr').children('td:nth-child(2)').html());
                            $('#dsem').html($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(1)').html());
                            $('#dsd').html($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(2)').html());
                            $('#ded').html($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(3)').html());

                        });
                        $('#team').change(function(){
                              $('#season').show();

                                                        $('#trainingCont').html('  <div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div><center><h5>Please Wait...</h5></center>');
                                                        $.post('{{route('adminViewSTraining')}}',{id:$('#tid').html(),team_id:$('#team').val()},function(html){
                                                            $('#trainingCont').html(html);
                                                            var ndx = 1;
                                                            $('#not').children('h1').each(function(){
                                                             var con;
                                                                if($('#team').children('option:nth-child('+ndx+')').html().toString().indexOf('span')!=-1)
                                                                     con = $('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0];
                                                                    else con = $('#team').children('option:nth-child('+ndx+')').html();
                                                               if($(this).html().toString() == "No")
                                                                   $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="No schedule has been set" >'+con+'<span style="color:red;font-size: 18px;">*</span></b>');
                                                                else
                                                                   $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="Update schedule" >'+$('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0]+'</b>');
                                                                    ndx++;
                                                            });

                                                        });

                                                        });

                        $('.sched').click(function(){
                              $('#sadd').hide();
                              $('#sreset').hide();
                              $('#supdate').show();
                              $('#sdelete').show();
                              $('#sea').val($(this).parent('td').parent('tr').children('td:nth-child(2)').html());
                              $('#sem').val($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(1)').html());
                              $('#sd').val($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(2)').html());
                              $('#ed').val($(this).parent('td').parent('tr').children('td:nth-child(3)').children('div:nth-child(3)').html());
                        });
                        $('#sdelete').click(function(e){
                            e.preventDefault();
                        });
                    });
                    function venueC(){
                       var ndx = document.getElementById('venue').selectedIndex;
                       $('#playerLimit').html($('#vcount').children('h1:nth-child('+(ndx+1)+')').html()+' available');
                    }
                    function updateSched(){
                         var days ='';
                         days += (document.getElementById('sun').checked)? ' s ':'';
                         days += (document.getElementById('mon').checked)? ' m ':'';
                         days += (document.getElementById('tue').checked)? ' t ':'';
                         days += (document.getElementById('wed').checked)? ' w ':'';
                         days += (document.getElementById('thur').checked)? ' th ':'';
                         days += (document.getElementById('fri').checked)? ' f ':'';
                         days += (document.getElementById('sat').checked)? ' st ':'';
                         var data = {"venue_id":document.forms['trainingSched']['venue_id'].value,"team_type":document.forms['trainingSched']['team_type'].value,"days":days,"timeRangeFrom":document.forms['trainingSched']['timeRangeFrom'].value,"timeRangeTo":document.forms['trainingSched']['timeRangeTo'].value,"t_id":$('#tid').html(),"team_id":$('#team').val()};
                         $.post('{{route('adminUpdateSTraining')}}',{data:data},function(html){
                             if(html.toString().indexOf('form')==-1){
                                 $('#alert').html(' <div class="alert alert-danger" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'+html+'</b></div>');
                                $(window).scrollY(0) ;
                              }
                              else{
                                 $('#trainingCont').html(html.toString().split('separate')[0]);
                                 $('#alert').html(' <div class="alert alert-success" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'+html.toString().split('separate')[1]+'</b></div>');
                                 var ndx = 1;
                                 $('#not').children('h1').each(function(){
                                     var con;
                                     if($('#team').children('option:nth-child('+ndx+')').html().toString().indexOf('span')!=-1)
                                     con = $('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0];
                                     else con = $('#team').children('option:nth-child('+ndx+')').html();
                                     if($(this).html().toString() == "No")
                                      $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="No schedule has been set" >'+con+'<span style="color:red;font-size: 18px;">*</span></b>');
                                      else
                                      $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="Update schedule" >'+$('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0]+'</b>');
                                       ndx++;
                                 });
                               }
                         });
                    }
                    function setSched(){
                                                var days ='';
                                                days += (document.getElementById('sun').checked)? ' s ':'';
                                                days += (document.getElementById('mon').checked)? ' m ':'';
                                                days += (document.getElementById('tue').checked)? ' t ':'';
                                                days += (document.getElementById('wed').checked)? ' w ':'';
                                                days += (document.getElementById('thur').checked)? ' th ':'';
                                                days += (document.getElementById('fri').checked)? ' f ':'';
                                                days += (document.getElementById('sat').checked)? ' st ':'';
                                                var data = {"venue_id":document.forms['trainingSched']['venue_id'].value,"team_type":document.forms['trainingSched']['team_type'].value,"days":days,"timeRangeFrom":document.forms['trainingSched']['timeRangeFrom'].value,"timeRangeTo":document.forms['trainingSched']['timeRangeTo'].value,"t_id":$('#tid').html(),"team_id":$('#team').val()};
                                                $.post('{{route('adminAddSTraining')}}',{data:data},function(html){
                                                  //  $('#trainingCont').html(html);
                                                    if(html.toString().indexOf('form')==-1){
                                                        $('#alert').html(' <div class="alert alert-danger" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'+html+'</b></div>');
                                                        $(window).scrollTop(0);
                                                    }
                                                    else{
                                                    $('#trainingCont').html(html.toString().split('separate')[0]);

                                                    $('#alert').html(' <div class="alert alert-success" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'+html.toString().split('separate')[1]+'</b></div>');
                                                     var ndx = 1;
                                                     $('#not').children('h1').each(function(){
                                                     var con;
                                                    if($('#team').children('option:nth-child('+ndx+')').html().toString().indexOf('span')!=-1)
                                                     con = $('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0];
                                                    else con = $('#team').children('option:nth-child('+ndx+')').html();
                                                    if($(this).html().toString() == "No")
                                                    $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="No schedule has been set" >'+con+'<span style="color:red;font-size: 18px;">*</span></b>');
                                                    else
                                                    $('#team').children('option:nth-child('+ndx+')').html('<b title="" data-toggle="popover" data-trigger="hover" data-content="Update schedule" >'+$('#team').children('option:nth-child('+ndx+')').html().toString().split('<span')[0]+'</b>');
                                                    ndx++;
                                                  });
                                                  }
                                                });
                    }
                    function change(){
                       var ndx = document.getElementById('team_type').selectedIndex;
                       $('#playerSize').html($('#count').children('h1:nth-child('+(ndx+1)+')').html() + '  players');
                    }
                    function togg(){
                        $('#trainDet').css('display',$('#trainDet').css('display').toString()=='none' ? 'block':'none');
                        $('#trainingSched').css('display',$('#trainingSched').css('display').toString()=='none' ? 'block':'none');
                        $('#toggEdit').css('display',$('#toggEdit').css('display').toString()=='none' ? 'inline':'none');
                        $('#toggView').css('display',$('#toggView').css('display').toString()=='none' ? 'inline':'none');
                    }
                    function haha(){
                        $('#scheduleList_filter').children('label:nth-child(1)').remove();
                                                $('#scheduleList_length').children('label:nth-child(1)').remove();
                                                $('#scheduleList_previous').remove();
                                                $('#scheduleList_next').remove();
                                                $('#scheduleList_info').remove();
                    }
                    setInterval(haha,0);
                </script>
                <style>
                    .input-group input{
                        width: 100%;
                    }
                    #scheduleList_paginate span a,.current{
                        font-size: 13px;
                        color: white;
                        padding: 0;
                    }
                </style>
@stop