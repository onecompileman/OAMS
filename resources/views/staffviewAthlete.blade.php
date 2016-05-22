@extends('staff')
@section('css')
<script src="/addons/js/jquery.dataTables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
	<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
     <script src="/addons/js/bootstrap.js"></script>


    <style>
        tbody tr{
            cursor:pointer;
        }
    </style>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="width: 140%;">
                          <div class="modal-header primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center><h3 style="color:#3498db;" class="modal-title"><b>A T H L E T E ' S &nbsp;&nbsp;P R O F I L E</b></h3></center>
                          </div>
                          <div class="modal-body">
                           <div id="modalcontent" style="margin-left:8%;">
                           </div>
                          </div>
                          <div class="modal-footer">

                               <div class=" btn btn-primary"><a href="" id="athleteprofile" style="color:white;"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; View Full Profile</a></div>
                               <div data-toggle="modal" data-target="#sanctions" id="sanction" class=" btn btn-warning"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp; Send Sanction To Athlete</div>
                               <div class="btn btn-danger" id="delete" data-toggle="modal" data-target="#confirm"><span class="glyphicon glyphicon-trash"></span>&nbsp; Delete Athlete</div>

                          </div>
                        </div>

                      </div>
                    </div>
   <div id="confirm" class="modal fade" role="dialog">
   <br/><br/><br/><br/><br/>
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title" style="color:#22cff6;"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;<b>C O N F I R M&nbsp;&nbsp; D I A L O G</b></h4></center>
                  </div>
                  <div class="modal-body">
                    <p class="messageAlert"></p>
                  </div>
                  <div class="modal-footer">
                  <a class="btn btn-danger" id="deleteAthlete" href=""><span class="glyphicon glyphicon-trash"></span>&nbsp; Delete</a>
                  <div class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-ban-circle"></span> &nbsp; Cancel</div>
                  </div>
                </div>

              </div>
            </div>
            <!-- Trigger the modal with a button -->

                        <!-- Modal -->
                        <div id="sanctions" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <center> <h4 class="modal-title" style="color:#22cff6;"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp; <b>S A N C T I O N</b></h4></center>
                              </div>
                               <form class="form-group" action="{{route('adminSendSanction')}}" method="post">
                              <div class="modal-body">

                                         <input type="hidden" name="athlete_id" id="athid"/>
                                                                   Sanction Type: <select class="form-control" name="sanction_type"><option value="School">School</option><option value="Personal">Personal</option><option value="Game">Game</option></select><br>
                                                                   Remarks: <textarea class="form-control" name="remarks" id="" cols="40" rows="10"></textarea>
                              </div>
                              <div class="modal-footer">
                                                                   <input type="submit" class="btn btn-warning" value="Send Sanction"/>
                                                                                                  <div data-dismiss="modal" class=" btn btn-danger">Cancel</div>

                              </div>
                               </form>
                            </div>

                          </div>
                        </div>
    <div class="row">
        <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
            <center><h3 style="color: #ffffff;"><b>A T H L E T E S &nbsp;&nbsp; L I S T S</b></h3></center>
        </div>
    </div>
    <br/>
    @if(Session::has('success'))
    <div class="row">
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

            <b>{{Session::get('success')}}</b>
        </div>
    </div>
        @endif
        @if(Session::has('add'))
            <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <b>{{Session::get('add')}}</b>
            </div>

        @endif
    <br/>

        <div class="panel" style="box-shadow: 0 0 3px 3px rgba(0,0,0,0.1);">
        <div class="row">
               <br>
               <div class="dropdown" style="margin-left: 3%;display: inline;">
                 <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: #0b2644;"><span class="glyphicon glyphicon-print" style="color:green;"></span>&nbsp;Print Player List
                 <span class="caret"></span></button>
                 <ul class="dropdown-menu">
                   <li><a href="{{route('adminPrintAthleteList')}}" target="_blank">All</a></li>
                    @if(isset($sportList))
                                                            @foreach($sportList as $sport)
                                                                <li><a href="{{route('adminPrintAthleteList')}}?sport={{$sport->sport_name}}" target="_blank">{{$sport->sport_name}}</a></li>
                                                             @endforeach
                                                       @endif
                 </ul>
               </div>
               <a href="{{route('adminAddAthlete')}}" target="_blank" class="btn btn-primary" style="margin-left: 3%;display: inline;background-color: #0b2644;"><strong style="color:red;"> + </strong>Add New Athlete </a>

   </div>
            <hr style="border: 1.5px solid #0b2644;"/>
            <div class="row">
            <div class="col-sm-12">

                <table id="athletesTable" class="table-bordered table-hover" cellspacing="0" width="100%">
                				<thead class="head" style="background-color:#0b2644;color:white;">
                					<tr>
                						<th>Name</th>
                						<th>Student ID</th>
                						<th>College</th>
                						<th>Team</th>
                						<th>Sport</th>
                						<th>Team Type</th>
                						<th>Sanctioned</th>
                						<th>Address</th>
                					</tr>
                				</thead>
                                	<tfoot>

                                                				</tfoot>
                				<tbody>
                                    @if(isset($athleteLists))
                                        @foreach($athleteLists as $athlete)

                                        <tr data-toggle="modal" data-target="#myModal" id="{{$athlete->id}}" class="ath" onclick="">
                                            <td>{{$athlete->given_name}} {{$athlete->middle_name}} {{$athlete->last_name}}</td>
                                            <td>{{$athlete->student_id}}</td>
                                            <td>{{$athlete->college_department}}</td>
                                            <td>{{$athlete->teamName}}</td>
                                            <td>{{$athlete->sport}}</td>
                                            <td>{{$athlete->team_type}}</td>
                                            <td>{{$athlete->sanc}}</td>
                                            <td>{{$athlete->home_address}}</td>

                                        </tr>
                                        @endforeach
                                    @endif
                				</tbody>
                			</table>

   </div>
</div>
</div>
 <script type="text/javascript" class="init">
        $(document).ready(function(){
           $.ajaxSetup({
                  	headers: {
                  		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  	        }
                  });
                   $('tbody').children('tr').click(function(){
                                  var id =$(this).attr('id');
                                  $('#modalcontent').html('  <center> <div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div></center><br/><center><h5>Please wait.....</h5></center>');
                                  $('#athleteprofile').attr('href','/OAMS/admin/athlete/'+id);
                                  $.post('{{route('adminviewSAthlete')}}',{id:id},function(html){
                                      $('#modalcontent').html(html);
                                  });
                              });
        $('#athletesTable').DataTable( {
        		initComplete: function (){
        			this.api().columns([2]).every( function () {
                        				var column = this;
                        				var select = $('<select class="btn btn-warning" style="position: absolute;top:-75px;left:36%;background-color: #0b2644;" ><option value="">All Colleges</option></select>')
                        					.appendTo( $(column.header()))
                        					.on( 'change', function () {
                        						var val = $.fn.dataTable.util.escapeRegex(
                        							$(this).val()
                        						);

                        						column
                        							.search( val ? '^'+val+'$' : '', true, false )
                        							.draw();
                        					} );
                        					        select.append( '<option  value="CCS">CCS</option>' );
                        					        select.append( '<option  value="CBA">CBA</option>' );
                                                    select.append( '<option  value="COE">COE</option>' );
                                                    select.append( '<option  value="COD">COD</option>' );
                                                    select.append( '<option  value="CON">CON</option>' );
                                                    select.append( '<option  value="CEAS">CEAS</option>' );
                        			} );
        			this.api().columns([4]).every( function () {
        				var column = this;
        				var select = $('<select style="position: absolute;top:-75px;left:50%;background-color: #0b2644;" class="btn btn-warning"><option value="">All Sports</option></select>')
        					.appendTo( $(column.header()))
        					.on( 'change', function () {
        						var val = $.fn.dataTable.util.escapeRegex(
        							$(this).val()
        						);

        						column
        							.search( val ? '^'+val+'$' : '', true, false )
        							.draw();
        					} );

                            @if(isset($sportList))
                                @foreach($sportList as $sport)
        					        select.append( '<option  value="'+"{{$sport->sport_name}}"+'">'+"{{$sport->sport_name}}"+'</option>' );
                                @endforeach
                            @endif
        			} );
        				this.api().columns([5]).every( function () {
                            				var column = this;
                            				var select = $('<select style="position: absolute;top:-75px;left:66%;background-color: #0b2644;" class="btn btn-danger"><option value="">All Team</option></select>')
                            					.appendTo( $(column.header()))
                            					.on( 'change', function () {
                            						var val = $.fn.dataTable.util.escapeRegex(
                            							$(this).val()
                            						);

                            						column
                            							.search( val ? '^'+val+'$' : '', true, false )
                            							.draw();
                            					} );


                            					select.append( '<option  value="Team A">Team A</option>' );
                            					select.append( '<option  value="Team B">Team B</option>' );


                            			} );
                            				this.api().columns([6]).every( function () {
                                                				var column = this;
                                                				var select = $('<select style="position: absolute;top:-75px;left:78%;background-color: #0b2644;" class="btn btn-success"><option value="">All Athletes</option></select>')
                                                					.appendTo( $(column.header()))
                                                					.on( 'change', function () {
                                                						var val = $.fn.dataTable.util.escapeRegex(
                                                							$(this).val()
                                                						);

                                                						column
                                                							.search( val ? '^'+val+'$' : '', true, false )
                                                							.draw();
                                                					} );

                                                                    @if(isset($_GET['sanc']))
                                                                    select.append( '<option  value="Yes" selected>Sanctioned</option>' );
                                                                    select.append( '<option  value="No">Not Sanctioned</option>' );
                                                                    @else
                                                                    select.append( '<option  value="Yes">Sanctioned</option>' );
                                                                    select.append( '<option  value="No">Not Sanctioned</option>' );
                                                                    @endif


                                                			} );
        		}
        	} );
        //	$('thead').children('tr').children('th').children('select').hide();
            $('.nav').children('li:nth-child(2)').addClass('active');
            $('.hs').children('input').val('Yes');
            $('#sanction').click(function(){
                $('#athid').val($('#playerId').val());
            });
            $('#delete').click(function (){
                   $('.messageAlert').html('<center><h3>Are you sure to delete this athlete?</h3></center>');
                   $('#deleteAthlete').attr('href','/OAMS/admin/deleteAthlete/'+$('#playerId').val());
            });
            $('select').change();
        });

    </script>
@stop