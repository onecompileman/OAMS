@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
        <link type="text/css" rel="stylesheet" href="/addons/css/bootstrap-responsive.min.css"/>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
     <script src="/addons/js/bootstrap.js"></script>
     <script>
        $(document).ready(function(){
             $('.nav').children("li:nth-child(6)").addClass('active');
             $('#applicants').DataTable({
                                                           		initComplete: function (){
                                                           			this.api().columns([2]).every( function () {
                                                                                                                           				var column = this;
                                                                                                                           				var select = $('<select class="btn btn-warning" style="position: absolute;top:2px;left:30%;background-color: #0b2644;" ><option value="">All Sports</option></select>')
                                                                                                                           					.appendTo( $(column.header()))
                                                                                                                           					.on( 'change', function () {
                                                                                                                           						var val = $.fn.dataTable.util.escapeRegex(
                                                                                                                           							$(this).val()
                                                                                                                           						);

                                                                                                                           						column
                                                                                                                           							.search( val ? '^'+val+'$' : '', true, false )
                                                                                                                           							.draw();
                                                                                                                           					} );
                                                                                                                                                    @foreach($sportList as $sport)
                                                                                                                           					        select.append( '<option  value="{{$sport->sport_name}}">{{$sport->sport_name}}</option>' );
                                                                                                                           			                @endforeach
                                                                                                                           			} );
                                                                                                                           			this.api().columns([3]).every( function () {
                                                                                                                                                                       				var column = this;
                                                                                                                                                                       				var select = $('<select class="btn btn-warning" style="position: absolute;top:2px;left:46%;background-color: #0b2644;" ><option value="">All Applicants</option></select>')
                                                                                                                                                                       					.appendTo( $(column.header()))
                                                                                                                                                                       					.on( 'change', function () {
                                                                                                                                                                       						var val = $.fn.dataTable.util.escapeRegex(
                                                                                                                                                                       							$(this).val()
                                                                                                                                                                       						);

                                                                                                                                                                       						column
                                                                                                                                                                       							.search( val ? '^'+val+'$' : '', true, false )
                                                                                                                                                                       							.draw();
                                                                                                                                                                       					} );

                                                                                                                                                                       					        select.append( '<option value="Male">Male</option>' );
                                                                                                                                                                       					        select.append( '<option value="Female">Female</option>' );

                                                                                                                                                                       			} );
                                                           		}});
             $('#applicants_length').hide();
             $('.app').click(function(){
                $('#cont').html('<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div><center><h5>Please wait...</h5></center>');
                $('#printApplicant').attr('href','/OAMS/admin/printApplicant/'+$(this).children('td:first-child').children('div:first-child').html());
                $.post('{{route('adminViewSApplicant')}}',{id:$(this).children('td:first-child').children('div:first-child').html()},function(html){
                    $('#cont').html(html);
                });
             });
        });
     </script>
     <style>
        .app{
          cursor:pointer;
        }
     </style>
@stop
@section('contents')
<!-- Trigger the modal with a button -->
            <!-- Modal -->
            <div id="applicantModal" class="modal fade" role="dialog">
              <div class="modal-dialog" style="width: 70%;margin-left: 15%;">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title" style="color:#2b98eb;"><b><span class="glyphicon glyphicon-file"></span></b>&nbsp;A P P L I C A N T ' S &nbsp; P R O F I L E</h4></center>
                  </div>
                  <div class="modal-body">
                    <div id="cont">

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <a class="btn btn-success" href="" target="_blank" id="printApplicant"><b><span class="glyphicon glyphicon-print"></span></b>&nbsp; Print Profile</a>
                    <button class="btn btn-info"><b>+</b>&nbsp;Add to tryout list</button>
                  </div>
                </div>

              </div>
            </div>
<div class="row">
         <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
             <center><h3 style="color: #ffffff;"><b>Applicant</b></h3></center>
         </div>
 </div>
 <br/>
 <br/>
    @if(Session::has('success'))
        <div class="alert bg-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <b>{{Session::get('success')}}</b>
        </div>

    @endif
     <div class="col-sm-12 well" style="background-color: white;">
           <table id="applicants" class="table-bordered table-hover">
            <thead><tr>
                <th>Date Applied</th>
                <th>Name</th>
                <th>Sport</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Video Link</th>
                </tr></thead>
                <tbody>
                    @foreach($applicantList as $applicant)
                    <tr  class="app" data-toggle="modal" data-target="#applicantModal"><td>{{$applicant->created_at}}<div style="display: none;">{{$applicant->id}}</div></td><td>{{$applicant->last_name}} {{$applicant->given_name}}</td><td>{{$applicant->sport}}</td><td>{{$applicant->gender}}</td><td>{{$applicant->address}}</td><td>{{$applicant->email}}</td><td>{{$applicant->ytlink}}</td></tr>
                    @endforeach
                </tbody>
           </table>
     </div>
@stop