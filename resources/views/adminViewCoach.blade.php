@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
     <script src="/addons/js/bootstrap.js"></script>
     <style>
        .coachP{
            cursor: pointer;
        }
     </style>
     <script>
        $(document).ready(function(){
            $('[data-toggle=popover]').popover();
        });
     </script>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->
            <div id="profile" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title" style="color: #0080ff;"><b><span class="glyphicon glyphicon-user"></span></b>&nbsp;C O A C H ' S &nbsp; P R O F I L E</h4></center>
                  </div>
                  <div class="modal-body">
                   <div class="container-fluid">

                        <div id="cont" class="row">

                        </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                   <button type="button" class="btn btn-danger" id="delete" data-toggle="modal" data-target="#confirm"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                   <button class="btn btn-primary"><b><span class="glyphicon glyphicon-eye-open"></span></b>&nbsp; View Full Profile</button>
                  </div>
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
                                <center><h4 class="modal-title" style="color: #0080ff;"><b><span class="glyphicon glyphicon-question-sign"></span></b>&nbsp; C O N F I R M A T I O N</h4></center>
                              </div>
                              <form action="{{route('adminDeleteCoach')}}" method="post">
                              <div class="modal-body">
                                <input type="hidden" id="delID" name="id"/>
                                <center>
                                    <h4>Are you sure to delete this coach from the coaches list?</h4>
                                    </center>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp; Cancel</button>
                                <button type="submit" class="btn btn-danger" ><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                              </div>
                              </form>
                            </div>

                          </div>
                        </div>
<div class="row">
        <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
            <center><h3 style="color: #ffffff;"><b>C O A C H E S &nbsp;&nbsp; L I S T S</b></h3></center>

        </div>
    </div>

    <br/>
    @if(Session::has('success'))
        <div class="alert bg-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <b>{{Session::get('success')}}</b>
        </div>
            @endif
    <div class="row well" style="background-color: white;">
                      <div class="col-sm-2">
                      <div class="dropdown">
                        <button id="dLabel" type="button" class="btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #0b2644;">
                          <b><span class="glyphicon glyphicon-print" style="color:green;"></span></b> Print Coach List
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            @foreach($sportList as $sport)
                                <li><a href="">{{$sport->sport_name}}</a></li>
                            @endforeach
                        </ul>
                      </div>
                    </div>
                    <div class="col-sm-2"><a href="{{route('adminAddCoachV')}}" target="_blank" class="btn btn-primary" style="background-color: #0b2644;"><b style="color:red;">+</b>&nbsp; Add New Coach</a></div>
                    <br/>
                    <hr style="border: 2px solid #0b2644;"/>
                    <div class="row">
                        <table class="table-bordered table-hover" id="coach">
                            <thead><tr style="background-color: #0b2644;color: #ffffff;">
                                <th>Name</th>
                                <th>Team</th>
                                <th>Address</th>
                                <th>Sport</th>
                                </tr></thead>
                                <tbody>
                                    @foreach($coachList as $coach)
                                <tr class="coachP" data-toggle="modal" data-target="#profile">
                                    <td>{{$coach->firstname}} {{$coach->surname}}</td>
                                    <td>{{$coach->team_name}}</td>
                                    <td>{{$coach->address}}</td>
                                    <td><div>{{$coach->sport_name}}</div><div style="display: none;">{{$coach->id}}</div></td>
                                    </tr>
                                    @endforeach
                                    </tbody>

                        </table>

                    </div>
                      </div>
                      <script>
                        $(document).ready(function(){
                        $('#delete').click(function(){
                             $('#delID').val($('#id').val());
                        });
                        $('.nav').children('li:nth-child(4)').addClass('active');
                            $('#coach').DataTable({initComplete: function (){

                                                          			this.api().columns([3]).every( function () {
                                                          				var column = this;
                                                          				var select = $('<select style="position: absolute;top:-63px;left:35%;background-color: #0b2644;" class="btn btn-warning"><option value="">All Sports</option></select>')
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
                                                          					        select.append( '<option style="color:black;" value="'+"{{$sport->sport_name}}"+'">'+"{{$sport->sport_name}}"+'</option>' );
                                                                                  @endforeach
                                                                              @endif
                                                          			} );


                                                          		}
                                                          	});
                                                          	$('.coachP').click(function(){
                                                          	    $('#cont').html('<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div><br/><center><h5>Please wait........</h5></center>');
                                                                $.post('{{route('adminViewSCoach')}}',{id:$(this).children('td:nth-child(4)').children('div:nth-child(2)').html()},function(html){
                                                                       $('#cont').html(html);
                                                                });
                                                          	});
                                                          	});

                      </script>
@stop