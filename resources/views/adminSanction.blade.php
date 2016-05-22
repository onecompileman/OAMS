@extends('staff')
@section('css')
<script src="/addons/js/jquery.dataTables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
     <script src="/addons/js/bootstrap.js"></script>
    <style>
        .warning{
            transition: 0.5s linear;
            font-size: 80px;color: #950000;
        }
        .warning:hover{
            font-size: 90px;
        }
        .profile{
            transition: 0.5s linear;
        }
        .profile:hover{
            transform: scale(1.1);
            border: 1px solid #3498db;
        }
    </style>
@stop
@section('contents')

            <div id="sanctionD" class="modal fade" role="dialog">
            <br/><br/><br/><br/><br/>
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title" style="color: #3498db;"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp; S A N C T I O N &nbsp; D E T A I L S</h4></center>
                  </div>
                  <form class="form-group" action="" method="post"></form>
                  <div class="modal-body">
                        
                  </div>
                  <div class="modal-footer">
                   <div class="btn btn-success"><b><span class="glyphicon glyphicon-ok"></span></b>&nbsp;Mark as Resolved</div>
                   <div class="btn btn-info"><b><span class="glyphicon glyphicon-eye-open"></span></b>&nbsp;View Coach Profile</div>
                  </div>
                  </div>
                </div>

              </div>
       
    <div class="row">
            <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
                <center><h3 style="color: #ffffff;"><b>A T H L E T E' S &nbsp;&nbsp; S A N C T I O N</b></h3></center>
            </div>
        </div>
    <br/>
                <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back to athlete's list"><a href="{{route('adminviewAthlete')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Athlete's Sanction</u> </h5>
        <br/>
    <div class="row panel" style="box-shadow: 0 0 3px 3px rgba(0,0,0,0.3);">
            @if(count($sanctionList)>0)
           <div class="panel panel-primary">
              <div class="panel-heading" style="background-color: #0b2644;">
                  <h4>SANCTION LIST</h4>
              </div>
              <div class="panel-body">
                    <div class="well">
                         <center><h3><b><span class="glyphicon glyphicon-info-sign"></span></b>&nbsp; ATHLETE'S INFORMATION</h3></center>
                         <hr style="border:2px solid white;"/>
                          <br/>
                         <img class="img-rounded profile col-sm-offset-1" src="sys_files/img/profile_pic/athlete/{{$athlete->profile_pic}}" alt="" height="150" width="180" style="box-shadow: 0 0 3px 3px rgba(0,0,0,0.2);"/>
                         <br/><br/><br/>
                         <div class="col-sm-offset-1">
                         <h4 style="margin-top: 5px;"><b>Name: </b>{{$athlete->given_name}} {{$athlete->last_name}}</h4>
                         <h4 style="margin-top: 5px;"><b>Student ID: </b>{{$athlete->student_id}}</h4>
                         <h4 style="margin-top: 5px;"><b>Contact No: </b>{{$athlete->contact_number}}</h4>
                         <h4 style="margin-top: 5px;"><b>College Department: </b>{{$athlete->college_department}}</h4>
                         </div>
                         <br/>
                         <div class="row">
                             <div class="col-sm-offset-9" style="display: inline;"><a href="/OAMS/admin/athlete/{{$athlete->id}}"><div class="btn btn-primary"><b><span class="glyphicon glyphicon-eye-open"></span></b>&nbsp;&nbsp;View Profile</div></a></div>
                             <div style="display: inline;"><div class="btn btn-warning"><b><span class="glyphicon glyphicon-envelope"></span></b>&nbsp;&nbsp;Send Message</div></div>
                             </div>
                    </div>
                    <br/>
                    <hr style="border: 2px solid #0b2644;"/>
                    <br/>
                    <div class="row">
                    <div class="col-sm-12">
                     <table id="sanctionList" class="table-bordered table-hover " cellspacing="0" width="100%">
                                   				<thead class="head" style="background-color:#0b2644;color:white;">
                                   					<tr>
                                   						<th>Date Sended</th>
                                   						<th>Coach Sended</th>
                                   						<th>Sanction Type</th>
                                   						<th>Resolved</th>
                                   					</tr>
                                   				</thead>
                            <tbody>
                                @foreach($sanctionList as $sanction)
                                       <tr class="san" data-toggle="modal" data-target="#sanctionD" style="cursor:pointer;">
                                               <td>{{date_format(date_create($sanction->created_at),'Y-m-d')}}</td>
                                               <td>{{$sanction->coachName}}</td>
                                               <td>{{$sanction->sanction_type}}</td>
                                               <td>{{$sanction->resolved}}</td>
                                               <input type="hidden" class="coach_id" value=""/>
                                               <input type="hidden" class="sanction_id" value="">
                                       </tr>
                               @endforeach
                            </tbody>
                     </table>
                   </div>
                 </div>
              </div>
           </div>
            @else
                    <br/>
                   <center><h1 class="warning" ><span class="glyphicon glyphicon-ban-circle"></span></h1></center>
                    @if(empty($athlete->items))
                    <center><h3>There is no athlete exists!</h3></center>
                    @else
                   <center><h3>There is no sanction(s) for {{$athlete->given_name}} {{$athlete->last_name}}</h3></center>
                    @endif
                    <br/>
    </div>
    @endif
    <script type="text/javascript" class="init">
        $(document).ready(function(){
             $('.nav').children('li:nth-child(2)').addClass('active');
            $('#sanctionList').DataTable( {
            		initComplete: function (){
            			this.api().columns([2]).every( function () {
            				var column = this;
            				var select = $('<select style="position:absolute;top:0px;left:20%;" class="btn btn-danger"><option value="">All Sanction Type</option></select>')
            					.appendTo( $(column.header()) )
            					.on( 'change', function () {
            						var val = $.fn.dataTable.util.escapeRegex(
            							$(this).val()
            						);

            						column
            							.search( val ? '^'+val+'$' : '', true, false )
            							.draw();
            					} );

            				column.data().unique().sort().each( function ( d, j ) {
            					select.append( '<option value="Personal">Personal</option>' );select.append( '<option value="School">School</option>' );select.append( '<option value="Game">Game</option>' );

            				} );
            			} );
            				this.api().columns([3]).every( function () {
                                    				var column = this;
                                    				var select = $('<select  style="position:absolute;top:0px;left:38%;" class="btn btn-warning"><option value="">All Sanctions</option></select>')
                                    					.appendTo( $(column.header()) )
                                    					.on( 'change', function () {
                                    						var val = $.fn.dataTable.util.escapeRegex(
                                    							$(this).val()
                                    						);

                                    						column
                                    							.search( val ? '^'+val+'$' : '', true, false )
                                    							.draw();
                                    					} );

                                    				column.data().unique().sort().each( function ( d, j ) {
                                    					select.append( '<option value="YES">Resolved</option>' );select.append( '<option value="NO">Unresolved</option>' );

                                    				} );
                                    			} );
            		}
            	} );
        });
    </script>
@stop