@extends('staff')
@section('css')
	<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<script src="/addons/js/jquery.dataTables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
     <script src="/addons/js/bootstrap.js"></script>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->
            <div id="venue" class="modal fade" role="dialog">
                    <br/><br/><br/><br/>
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <center><h4 class="modal-title" style="color:#3498db;"><b><span class="glyphicon glyphicon-globe"></span></b>&nbsp; T R A I N I N G &nbsp; V E N U E</h4></center>
                  </div>
                   <form class="form-group" action="" id="formVenue" method="post">
                  <div class="modal-body con">


                  </div>
                  <div class="modal-footer">
                   <button type="reset" class="btn btn-warning" id='resets'><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp;Reset</button>
                   <button class="btn btn-danger" id="deletes" data-toggle="modal" data-target="#confirm"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp;Delete</button>
                   <button class="btn btn-info" id="update"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp;Update</button>
                    <button class="btn btn-info" id="add"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp;Add</button>
                  </div>
                   </form>
                </div>

              </div>
            </div>
            <!-- Trigger the modal with a button -->

                        <!-- Modal -->
                        <div id="confirm" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <center><h4 class="modal-title"><b><span class="glyphicon glyphicon-question-sign"></span></b>&nbsp; C O N F I R M A T I O N</h4></center>
                              </div>
                              <form action="{{route('adminDeleteVenue')}}" method="post">
                              <div class="modal-body">
                               <h4>Are you sure to delete this venue?</h4>
                               <input type="hidden" name="id" id="delId"/>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp;Cancel</button>
                                <button type="submit" class="btn btn-info">Yes</button>
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
                        <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back to schedule"><a href="{{route('adminSchedule')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Training Venue</u> </h5>
                <br/>
    @if(Session::has('success'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <b>{{Session::get('success')}}</b>
    </div>
    @endif
<div class="row panel" style="box-shadow: 0 0 3px 3px rgba(0,0,0,0.2);padding:30px;">
<div>
  <div id="addV" class="btn btn-info" style="position: relative;display: inline;background-color: #0b2644;" data-toggle="modal" data-target="#venue"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add Training Venue</div> <center > <h4 style="position: relative; display: inline;"><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; Training Venue List</h4></center>
   </div>
   <hr style="border: 2px solid #0b2644;"/>
   <br/>
   <div class="row">
   <table id="vvv" class="table table-hover" cellpadding="0" width="100%">
    <thead class="head" style="background-color: #0b2644;color:white;">
    <tr>
        <th>ID</th>
        <th>Venue Name</th>
        <th>Address</th>
        <th>Player Limit</th>
        </tr></thead>
        <tbody>
            @foreach($venueList as $venue)
                <tr data-toggle="modal" data-target="#venue" class="vl" style="cursor: pointer;">
                    <td>{{$venue->id}}</td><td>{{$venue->venue_name}}</td><td>{{$venue->address}}</td><td>{{$venue->playerLimit}}</td>
                </tr>
            @endforeach
        </tbody>
   </table>
   </div>
</div>
<script type="text/javascript" class="init">
       $(document).ready(function(){
       $('.nav').children('li').removeClass('active');
       $('.nav').children('li:nth-child(3)').addClass('active');
           $('#vvv').DataTable();
           $('#update').hide();
           $('#deletes').hide();
           $('#addV').click(function(){
                $('#formVenue').attr('action','{{route('adminAddVenue')}}');
                $('#update').hide();
                $('#deletes').hide();
                             $('#resets').show();
                             $('#add').show();
                $('.con').html('<br/><br/><input class="form-control" type="text" name="venue_name" placeholder="Venue Name" maxlength="255"/><br/> <input class="form-control" type="text" name="address" placeholder="Venue Address" maxlength="255" /><br/><input class="form-control" type="number" name="playerLimit" placeholder="Player Limit" max="200" min="20"/><br/><br/>');
           });
           $('#add').click(function(){
                        $('#formVenue').submit();
           });
           $('.vl').click(function(){
             $('#deletes').show();
             $('#update').show();
             $('#resets').hide();
             $('#add').hide();
             $('.con').html('<input type="hidden" name="id" id="id" value="'+$(this).children('td:first-child').text()+'"<br/><br/><input class="form-control" type="text" name="venue_name" placeholder="Venue Name" maxlength="255" value="'+$(this).children('td:nth-child(2)').html()+'"/><br/> <input class="form-control" type="text" name="address" placeholder="Venue Address" maxlength="255" value="'+$(this).children('td:nth-child(3)').html()+'"/><br/><input class="form-control" type="number" name="playerLimit" placeholder="Player Limit" max="200" min="20" value="'+$(this).children('td:nth-child(4)').html()+'"/><br/><br/>');
           });
           $('#update').click(function(){
            $('#formVenue').attr('action','{{route('adminUpdateVenue')}}');
            $('#formVenue').submit();
           });
           $('#deletes').click(function(){
                $('#delId').val($('#id').val());
           });
       });
   </script>
@stop