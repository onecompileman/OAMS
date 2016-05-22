@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
        <link type="text/css" rel="stylesheet" href="/addons/css/bootstrap-responsive.min.css"/>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
     <script src="/addons/js/bootstrap.js"></script>


     <script>
        $(document).ready(function(){
                $('.nav').children('li:nth-child(4)').addClass('active');
                var err=false;
             $('#username').keyup(function(){
                var str = $('.userList').html();
                    $('#usernameComm').html('');
                if(str.indexOf('<li>'+$(this).val()+'</li>')!=-1 && $(this).val() != ''){
                    err=true;
                    $('#usernameComm').html('Username already exist!');
                }
                else err=false;

             });
             $('#formData').submit(function(e){
             $('#passwordComm').html('');
                if($('#password1').val() != $('#password2').val()){
                    err = true;
                                 $('#passwordComm').html('Password didnt match!');
                    }
                if(err){
                    alert('There some error in the information you provided! ');
                     err=false;
                     return false;
                    }
                else
                    return true;


             });
        });
     </script>
@stop
@section('contents')
           <div class="row">
                       <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
                           <center><h3 style="color: #ffffff;"><b>A D D &nbsp; C O A C H</b></h3></center>
                       </div>
                   </div>

                     <br/>
                             <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back schedule" onload="$(this).popover()"><a href="{{route('adminViewCoach')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Add Coach</u> </h5>
                           <br/>
                            @if(Session::has('success'))
                                              <div class="alert alert-success">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <b>{{Session::get('success')}}</b>
                                              </div>
                                              @endif
                           <div class="row well" style="background-color: white;">
                                <br/>

                                <form action="{{route('adminAddCoach')}}" method="post" class="form-group" id="formData" enctype="multipart/form-data">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne" style="background-color: #0b2644;">
                                      <h4 class="panel-title">
                                      <br/>
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          <b><span class="glyphicon glyphicon-file"></span></b>&nbsp;Personal Data
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="panel-body">
                                            <div class="col-sm-12 well">
                                                <br/>
                                                <div class="row">
                                                <div class="col-sm-4">
                                                <input class="form-control" type="text" name="surname" placeholder="Lastname" aria-required required/>
                                                </div> <div class="col-sm-4">
                                                <input class="form-control" type="text" name="firstname" placeholder="Firstname" aria-required required />
                                                </div> <div class="col-sm-4">
                                                <input class="form-control" type="text" name="middlename" placeholder="Middlename" aria-required required/>
                                                </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="form-control" type="text" name="address" placeholder="Address" aria-required required/>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <b>Gender: </b><select class="form-control" name="gender" id=""><option value="Male">Male</option><option value="Female">Female</option></select>
                                                    </div>
                                                    <div class="col-sm-4"><br/><input class="form-control" type="text" name="civil_status" placeholder="Civil Status"/></div>
                                                    <div class="col-sm-4"><b>Birthdate: </b><input class="form-control" type="date" name="birth_day"/></div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <b>Blood Type: </b><select class="form-control" name="blood_type" id=""><option value="O">O</option><option value="A">A</option><option value="B">B</option><option value="AB">AB</option></select>
                                                    </div>
                                                    <div class="col-sm-4"><b>Team ID: </b><select class="form-control" name="team_id" id="">@foreach($teamList as $team)<option value="{{$team->id}}">{{$team->team_name}}</option> @endforeach</select></div>

                                                    <div class="col-sm-4"><br/><input class="form-control" type="text" name="contactno" placeholder="Contact No"/></div>
                                                </div>
                                                <br/>
                                                <div class="row"><div class="col-sm-12"><textarea class="form-control" placeholder="Maintenance Meds if any.." name="maintenance_meds" id="" cols="30" rows="6"></textarea></div></div>
                                            </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0b2644;">
                                      <h4 class="panel-title">
                                      <br/>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          <b><span class="glyphicon glyphicon-user"></span></b>&nbsp; User Credentials
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                      <div class="panel-body">
                                        <div class="col-sm-12 well">
                                        <br/>
                                               <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="2500000"/>
                                                    <b>Profile Picture: </b>
                                                   <div class="controls">
                                                                                                           <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="">
                                                                                                               <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="/sys_files/img/user.jpg"></div>
                                                                                                               <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                                                               <div>
                                                                                                                   <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="profile_pic" aria-required required></span>
                                                                                                                   <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                                                                               </div>

                                               </div>
                                               <br/>
                                               <hr/>
                                               <br/>
                                               <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1 input-group"><span class="input-group-addon" id="1" style=""><span class="glyphicon glyphicon-user "></span></span><input  class="form-control" type="text" aria-describedby="1" placeholder="Username" id="username" name="username" aria-required required/></div>
                                                    </div>

                                                    <div class="row">
                                                    <center><div class="" id="usernameComm" style="color:red;"></div></center>
                                                       </div>
                                                    <br/>
                                                    <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1 input-group"><span class="input-group-addon" id="2"><span class="glyphicon glyphicon-lock"></span></span><input class="form-control" aria-describedby="2" type="password" placeholder="Password" id="password1" name="password" aria-required required/></div>
                                                    </div>
                                                    <br/><br/>
                                                    <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1 input-group"><span class="input-group-addon" id="3"><span class="glyphicon glyphicon-lock"></span></span><input class="form-control" aria-describedby="3" type="password" placeholder="Confirm  Password" id="password2" aria-required required/></div>
                                                        </div>
                                                         <div class="row">
                                                                                                            <center><div class="" id="passwordComm" style="color:red;"></div></center>
                                                                                                               </div>
                                                    <br/><br/><br/>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                    <br/>

                                      <center>  <button class="btn btn-success" id="submit" type="submit"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add Coach</button></center>
                                    <br/>
                                </form>
                                <br/>

                           </div>
            <ul class="userList" style="display: none;">
                @foreach($userList as $user)
                <li>{{$user->username}}</li>
                @endforeach
            </ul>
@stop