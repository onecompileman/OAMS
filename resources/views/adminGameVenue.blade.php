@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
     <script src="/addons/js/bootstrap.js"></script>
     <style>
        .gameVenue{
            cursor:pointer;
        }
     </style>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->
           <!-- Trigger the modal with a button -->

                       <!-- Modal -->
                       <div id="venue" class="modal fade" role="dialog">
                        <br/><br/><br/><br/>
                                                     <div class="modal-dialog">

                                                       <!-- Modal content-->
                                                       <div class="modal-content">
                                                         <div class="modal-header">
                                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                           <center><h4 class="modal-title" style="color:#4cd8d8;">G A M E &nbsp; V E N U E</h4></center>
                                                         </div>
                                                         <form class="form-group" id="game" action="{{route('adminAddGameVenue')}}" method="post" enctype="multipart/form-data">
                                                         <div class="modal-body">
                                                         <br/>
                                                            <div class="row">
                                                            <div class="col-sm-offset-1">
                                                                  <input type="hidden" name="id" id="id"/>
                                                              </div>
                                                              </div>
                                                              <br/>
                                                             <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                                                             <div class="row">
                                                             <div class="col-sm-3"><b>Venue Image:  </b></div>
                                                             <br/>
                                                                                                                <div class="controls">
                                                                                                                                                                        <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="">
                                                                                                                                                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="/sys_files/img/user.jpg" id="img"></div>
                                                                                                                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                                                                                                                            <div>
                                                                                                                                                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="img" class="form-control" aria-required required/></span>
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
                                                           <button type="button" id="reset" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp;Reset</button>
                                                           <button type="submit" id="add" class="btn btn-info"  ><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp;Add</button>
                                                           <button type="submit" id="update" class="btn btn-primary"  ><b><span class="glyphicon glyphicon-send"></span></b>&nbsp;Update</button>
                                                           <button type="button" id="delete" class="btn btn-danger"  data-toggle="modal" data-target="#confirm"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp;Delete</button>
                                                         </div>
                                                         </form>
                                                       </div>

                                                     </div>
                       </div>
                       <!-- Trigger the modal with a button -->

                                   <!-- Modal -->
                                   <div id="confirm" class="modal fade" role="dialog">
                                   <br/><br/><br/><br/><br/><br/><br/><br/><br/>
                                     <div class="modal-dialog">

                                       <!-- Modal content-->
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                           <center><h4 class="modal-title" style="color:#22cff6;"><b><span class="glyphicon glyphicon-question-sign"></span></b>  &nbsp; C O N F I R M A T I O N</h4></center>
                                         </div>
                                            <form action="{{route('adminDeleteGameVenue')}}" method="post">
                                         <div class="modal-body">
                                            <input type="hidden" id="delID" name="id"/>
                                           <center><b>Are you sure to delete this venue?</b></center>
                                         </div>
                                         <div class="modal-footer">
                                           <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp;Cancel</button>
                                            <button class="btn btn-danger"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
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
                                       <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back schedule" onload="$(this).popover()"><a href="{{route('adminSchedule')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Game Venue</u> </h5>
                               <br/>
                               @if(Session::has('success'))
                               <div class="alert alert-success">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <b>{{Session::get('success')}}</b>
                               </div>
                               @endif
                               <div class="row well" style="background-color: white;">
                                    <div class="btn btn-primary" id="addN" data-toggle="modal" data-target="#venue" style="background-color: #0b2644;"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add Game Venue</div>
                                    <hr style="border:1px solid black;"/>
                                        <center><h4><b><span class="glyphicon glyphicon-th"></span>&nbsp; Game Venue</b></h4></center>
                                                                        <hr style="border:1px solid black;"/>
                                        <div class="row">
                                        <table id="gameVenue" class="table-bordered table-hover">
                                            <thead><tr style="background-color: #0b2644;color:white;">
                                                <th>Id</th>
                                                <th>Venue Name</th>
                                                <th>Address</th>
                                                </tr></thead>
                                                <tbody>
                                                    @foreach($gameVenue as $venue)
                                                    <tr class="gameVenue" data-toggle="modal" data-target="#venue">

                                                        <td>{{$venue->id}}</td><td>{{$venue->venue_name}}</td><td><div>{{$venue->address}}</div><div style="display:none;">{{$venue->img}}</div></td>
                                                    </tr>
                                                        @endforeach
                                                </tbody>
                                        </table>
                                        </div>
                               </div>
                               <script>
                                    $(document).ready(function(){
                                    $('.nav').children('li:nth-child(3)').addClass('active');
                                        $('#gameVenue').DataTable();
                                        $('#update').hide();
                                        $('#delete').hide();
                                        $('#addN').click(function(){
                                                $('#img').hide();
                                              $('#update').hide();
                                                                                                                                       $('#delete').hide();
                                                                                                $('#game').attr('action','{{route('adminAddGameVenue')}}');
                                                                                   $('#add').show();
                                                                                                                                   $('#reset').show();
                                        });
                                        $('#delete').click(function(){
                                            $('#delID').val($('#id').val());
                                        });
                                        $('.gameVenue').click(function(){
                                              $('#img').show();
                                                $('#game').attr('action','{{route('adminUpdateGameVenue')}}');
                                               $('#img').attr('src','/sys_files/img/gamevenue/'+$(this).children('td:nth-child(3)').children('div:nth-child(2)').html());
                                               $('#update').show();
                                                                                       $('#delete').show();
                                                                                       $('#add').hide();
                                                                                       $('#reset').hide();
                                               $('#id').val($(this).children('td:nth-child(1)').html());
                                                $('[name="venue_name"]').val($(this).children('td:nth-child(2)').html());
                                                $('[name="address"]').val($(this).children('td:nth-child(3)').children('div:first-child').html());
                                        });
                                    });
                               </script>
@stop