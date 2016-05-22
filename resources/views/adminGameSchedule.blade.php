@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
     <script src="/addons/js/bootstrap.js"></script>
     <script>

     </script>
     <style>
        select::-webkit-scrollbar{
            background-color: #20203f;
            width: 5px;
        }
        select::-webkit-scrollbar-thumb{
            background-color: #4cd8d8   ;
        }
        .sched{
            cursor: pointer;
        }
     </style>
@stop
@section('contents')
    <!-- Trigger the modal with a button -->

                <!-- Modal -->
                <div id="addGame" class="modal fade" role="dialog">
                    <br/><br/><br/><br/>
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <center><h4 class="modal-title" style="color: #91e0ff;"><b><span class="glyphicon glyphicon-th"></span></b>&nbsp; G A M E &nbsp; S C H E D U L E</h4></center>
                      </div>
                      <form class="form-group" action="{{route('adminAddGameSchedule')}}" method="post" name="gameschedule" id="formGame">
                      <div class="modal-body">
                      <div class="row">
                      <br/>
                            <input type="hidden" name="id" id="id"/>
                           <div class="col-sm-3"><b>Team: </b></div> <div class="col-sm-9"><select class="form-control" name="team_id" id="team">
                                @foreach($teamList as $team)
                                    <option value="{{$team->id}}">{{$team->team_name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <br/><br/><br/>
                            <div class="col-sm-3"><b>Opposing Team: </b></div>
                            <div class="col-sm-9">
                            <select class="form-control" name="opposingTeam" id="opp">
                                <option value="ADMU">Ateneo De Manila University</option><option value="ADU">Adamson University</option><option value="DLSU">De La Salle State University</option><option value="FEU">Far Eastern University</option><option value="UE">University of the East</option><option value="UP">University of the Philippines</option><option value="UST">University of Santo Thomas</option>
                            </select>
                            </div>
                            <br/><br/><br/>
                            <div class="col-sm-3"><b>Venue: </b></div>
                            <div class="col-sm-9"><select class="form-control" name="venue_id" id="venue_id">
                            @foreach($gameVenue as $venue)
                                <option value="{{$venue->id}}">{{$venue->venue_name}}</option>
                            @endforeach
                            </select></div>
                            <br/>
                            <div class="col-sm-9 col-sm-offset-3">
                                <a  data-toggle="modal" data-target="#gameVenue"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add new venue</a>
                            </div>
                            <br/><br/><br/>

                            <div class="col-sm-3"><b>Date of Game: </b></div>
                            <div class="col-sm-9"><input type="date" name="dateOfGame" id="dateG" class="form-control" aria-required required min="{{date('Y-m-d')}}" /></div>
                            <br/><br/><br/>
                            <div class="col-sm-3"><b>Time of Game: </b></div>
                            <div class="col-sm-9"><input type="time" name="timeOfGame" id="timeG" class="form-control" aria-required required/></div>

                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-warning" data-dismiss="modal" id="resetBtn"><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp; Reset</button>
                        <button class="btn btn-info" id="addBtn"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add </button>
                        <button class="btn btn-primary" id="updateBtn"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Update </button>
                        <button class="btn btn-danger" id="deleteBtn" data-toggle="modal" data-target="#confirm"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete </button>
                      </div>
                      </form>
                    </div>

                  </div>
                </div>
                <!-- Trigger the modal with a button -->

                            <!-- Modal -->
                            <div id="gameVenue" class="modal fade" role="dialog">
                            <br/><br/><br/><br/>
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <center><h4 class="modal-title" style="color:#4cd8d8;">G A M E &nbsp; V E N U E</h4></center>
                                  </div>
                                  <form class="form-group" action="{{route('adminAddGameVenue')}}" method="post" enctype="multipart/form-data">
                                  <div class="modal-body">
                                  <br/>
                                      <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                                      <div class="row">
                                      <div class="col-sm-3"><b>Venue Image:  </b></div>
                                       <div class="controls">
                                                                                                                                                 <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="">
                                                                                                                                                     <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="/sys_files/img/user.jpg"></div>
                                                                                                                                                     <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                                                                                                     <div>
                                                                                                                                                         <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>                                    <input type="file" name="img" class="form-control" aria-required required/>
</span>
                                                                                                                                                         <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                                                                                                                     </div>

                                      </div>
                                      </div>
                                     <br/>
                                    <input class="form-control" type="text" name="venue_name" placeholder="Venue Name" aria-required required/>
                                    <br/>
                                    <input type="text" class="form-control" name="address" placeholder="Venue Address" aria-required required/>
                                    <br/>
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="reset" class="btn btn-warning" ><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp;Reset</button>
                                    <button type="submit" class="btn btn-info"  ><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp;Add</button>
                                  </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                            <!-- Trigger the modal with a button -->

                                        <!-- Modal -->
                                        <div id="confirm" class="modal fade" role="dialog">
                                        <br/><br/><br/><br/><br/><br/><br/>
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <center><h4 class="modal-title" style="color:#22cff6;"><b><span class="glyphicon glyphicon-question-sign"></span>&nbsp; C O N F I R M A T I O N</b></h4></center>
                                              </div>
                                              <form action="{{route('adminDeleteGameSchedule')}}">
                                              <div class="modal-body">
                                                <input type="hidden" id="delID" name="id"/>
                                                <p>Are you sure to delete this game schedule?.</p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp; Cancel</button>
                                                <button type="submit" class="btn btn-danger"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
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
                                   <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back schedule" onload="$(this).popover()"><a href="{{route('adminSchedule')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Game Schedule</u> </h5>
                           <br/>
                           @if(Session::has('success'))
                           <div class="alert alert-success">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <b>{{Session::get('success')}}</b>
                           </div>
                           @endif
                <div class="row well" style = "background-color: white;">
                <div class="col-sm-12">
                <div class="btn btn-info" id="addN" data-toggle="modal" data-target="#addGame" style="background-color: #0b2644;display: inline-block;"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add Game Schedule</div>
               <div class="btn-group btn-group-justified" style=";display: inline-block; width: 30%;margin-left: 3%;"> <a href="{{route('adminPrintGameSchedule')}}" target="_blank" class="btn btn-primary" id="print" style="background-color: #0b2644;display: inline;"><b><span class="glyphicon glyphicon-print"></span></b>&nbsp; Print Upcoming Game Schedules</a> <select class="btn btn-primary" style="background-color: #0b2644;display:inline;margin-left: -2%;height: 30px;" id="teamS" name="team" id=""><option value="">All Teams</option>@foreach($teamList as $team) <option value="{{$team->id}}">{{$team->team_name}}</option> @endforeach</select></div>
                <div class="row">
                <hr style="border:2px solid #20203f;"/>
                        <table id="gameschedule" class="table-bordered table-hover">
                            <thead><tr style="background-color:#0b2644;color:white;">
                                <th>Team</th>
                                <th>Opposing Team</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Venue</th>
                                <th>Upcoming</th>
                                </tr></thead>
                                <tbody>
                                    @foreach($gameschedule as $game)
                                        <tr class="sched" data-toggle="modal" data-target="#addGame" >
                                            <td>{{$game->teamName}}</td>
                                            <td>{{$game->opposingTeam}}</td>
                                            <td>{{$game->dateOfGame}}</td>
                                            <td>{{$game->timeOfGame}}</td>
                                            <td><div>{{$game->venueName}}</div><div style="display: none;">{{$game->venue_id}}</div></td>
                                            <td><div>{{$game->upcoming}}</div><div style="display:none;">{{$game->id}}</div></td>
                                            </tr>
                                    @endforeach
                                </tbody>
                        </table>
                </div>
                </div>
        </div>
    <script>
        $(document).ready(function(){
            $('.nav').children('li').removeClass('active');
            $('.nav').children('li:nth-child(3)').addClass('active');
            $('#teamS').change(function(){
                    if(document.getElementById('teamS').selectedIndex == 0)
                        $('#print').attr('href','{{route('adminPrintGameSchedule')}}');
                    else
                        $('#print').attr('href','{{route('adminPrintGameSchedule')}}?team='+$(this).val());
            });
            $('#deleteBtn').click(function(){
                $('#delID').val($('#id').val());
            });
            $('.sched').click(function(){
            $('#id').val($(this).children('td:nth-child(6)').children('div:nth-child(2)').html());
                     $('#deleteBtn').show();
                                               $('#updateBtn').show();
                                               $('#addBtn').hide();
                                               $('#resetBtn').hide();
                                               $('#venue_id').val($(this).children('td:nth-child(5)').children('div:nth-child(2)').html());
                                               $('#team_id').val($(this).children('td:first-child').html());
                                               $('#opp').val($(this).children('td:nth-child(2)').html());
                                               $('#dateG').val($(this).children('td:nth-child(3)').html());
                                               $('#timeG').val($(this).children('td:nth-child(4)').html());

            });
            $('#addN').click(function(){
                  $('#deleteBtn').hide();
                                            $('#updateBtn').hide();
                                            $('#addBtn').show();
                                            $('#resetBtn').show();
                                             $('#dateG').val('');
                                                                                           $('#timeG').val('');
                                                                                        document.getElementById('venue_id').selectedIndex = 0;
                                                                                         document.getElementById('team').selectedIndex = 0;
                                                                                         document.getElementById('opp').selectedIndex = 0;
            });
            $('#addBtn').click(function(e){
                e.preventDefault();
                var exist = false;
                $('tbody').children('tr').each(function(){
                var strCmp =$(this).html().toString();
                    if(strCmp.indexOf($('#team').children('option:selected').html()) != -1 && strCmp.indexOf($('#opp').val()) != -1 && strCmp.indexOf($('#dateG').val()) !=-1)
                        exist =true;
                });
                if(exist) alert('Theres already a the same schedule!');
                else{
                    $('#formGame').submit();
                }
            });
            $('#deleteBtn').hide();
            $('#updateBtn').hide();

             $('#gameschedule').DataTable( {
                   		initComplete: function (){
                   			this.api().columns([5]).every( function () {
                                                                                   				var column = this;
                                                                                   				var select = $('<select class="btn btn-warning" style="position: absolute;top:-75px;left:50%;background-color: #0b2644;" ><option value="">All Schedules</option></select>')
                                                                                   					.appendTo( $(column.header()))
                                                                                   					.on( 'change', function () {
                                                                                   						var val = $.fn.dataTable.util.escapeRegex(
                                                                                   							$(this).val()
                                                                                   						);

                                                                                   						column
                                                                                   							.search( val ? '^'+val+'$' : '', true, false )
                                                                                   							.draw();
                                                                                   					} );
                                                                                   					        select.append( '<option style="color:black;" value="Yes">Upcoming</option>' );
                                                                                   					        select.append( '<option style="color:black;" value="No">Transpired</option>' );
                                                                                   			} );
                                                                                   			this.api().columns([0]).every( function () {
                                                                                                                               				var column = this;
                                                                                                                               				var select = $('<select class="btn btn-warning" style="position: absolute;top:-75px;left:66%;background-color: #0b2644;" ><option value="">All Teams</option></select>')
                                                                                                                               					.appendTo( $(column.header()))
                                                                                                                               					.on( 'change', function () {
                                                                                                                               						var val = $.fn.dataTable.util.escapeRegex(
                                                                                                                               							$(this).val()
                                                                                                                               						);

                                                                                                                               						column
                                                                                                                               							.search( val ? '^'+val+'$' : '', true, false )
                                                                                                                               							.draw();
                                                                                                                               					} );
                                                                                                                               					        @foreach($teamList as $team)
                                                                                                                               					        select.append( '<option style="color:black;" value="{{$team->team_name}}">{{$team->team_name}}</option>' );
                                                                                                                               					       @endforeach
                                                                                                                               			} );
                   		}
                   	} );
        });
    </script>
@stop