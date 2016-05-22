@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
     <script src="/addons/js/bootstrap.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                $('.nav').children('li:nth-child(2)').addClass('active');
                $('[data-toggle="popover"]').popover();
                $('#editbtn').click(function(){
                    $('#view').css('display',($('#view').css('display').toString() == "none")? 'block':'none');
                    $('#edit').css('display',($('#edit').css('display').toString() == "none")? 'block':'none');
                    $('#update').css('display',((($('#update').css('display').toString() == "none"))? 'block':'none'));
                    $(this).html(($(this).html()== '<b><span class="glyphicon glyphicon-edit"></span></b>&nbsp; Edit Profile')? '<b><span class="glyphicon glyphicon-eye-open"></span></b>&nbsp; View Profile':'<b><span class="glyphicon glyphicon-edit"></span></b>&nbsp; Edit Profile');
                });
            });
    </script>
    <style>
        #edit{
            display: none;
        }
           .warning{
                    transition: 0.5s linear;
                    font-size: 80px;color: #950000;
                }
                .warning:hover{
                    font-size: 90px;
                }
                .profilepic{
                    transition: 0.5s linear;
                }
                .profilepic:hover{
                    transform: scale(1.1);
                }
                #update{
                display: none;
                }
                .well h5{
                    color:black;
                }
                a:hover{
                    text-decoration: none;
                }
    </style>
@stop
@section('contents')
    <div class="row">
        <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
            <center><h3 style="color: #ffffff;"><b>A T H L E T E S &nbsp;&nbsp; L I S T S</b></h3></center>
        </div>
    </div>
    <br/>
                    <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back to athlete's list"><a href="{{route('adminviewAthlete')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;<u> Athlete's Profile</u> </h5>
            <br/>
            
            @if(Session::has('success'))
            <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <b>{{Session::get('success')}}</b>
            </div>
            @endif
            <!-- Trigger the modal with a button -->

                        <!-- Modal -->
                        <div id="confirm" class="modal fade" role="dialog">
                        <br/><br/><br/><br/><br/><br/><br/><br/>
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <center><h4 class="modal-title" style="color:#3498db;"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;C O N F I R M A T I O N</h4></center>
                              </div>
                              <div class="modal-body">
                                 <center><h5>Are you sure to delete the profile of this athlete? </h5></center>
                              </div>
                              <div class="modal-footer">
                                <div>
                                    <div class="btn btn-warning"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp; Cancel</div>
                                     <div class="btn btn-danger"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
<div class="row panel" style="box-shadow: 0 0 3px 3px rgba(0,0,0,0.3);">
<br/>
<div>
@if($exists)
    <div class="btn btn-info col-xs-offset-1" id="editbtn"><b><span class="glyphicon glyphicon-edit"></span></b>&nbsp; Edit Profile</div>
    <div class="btn btn-primary" style="margin-left: 3%;"><a href="/OAMS/admin/printAthlete/{{$athleteData->id}}" target="_blank" style="color:white;"><b><span class="glyphicon glyphicon-print"></span></b>&nbsp; Print Profile</a></div>
    <div data-toggle="modal" data-target="#confirm" class="btn btn-danger" style="margin-left: 3%;"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete Athlete</div>
@endif
</div>
<hr style="border: 2px solid #0b2644;"/>
@if(!$exists)
<div class="row">
        <br/>
                       <center><h1 class="warning" ><span class="glyphicon glyphicon-ban-circle"></span></h1></center>
                        <center><h3>There is no athlete exists!</h3></center>
</div>
@else

    <div class="row">
    <div class="col-xs-11 panel" style="margin-left: 4.5%;box-shadow: 0 0 3px 3px rgba(0,0,0,0.1);border:1.5px solid #22cff6;">
<form id="view" class="form-group">
<section class="invoice">
      <center>  <h3><b><span class="glyphicon glyphicon-user"></span></b>&nbsp; A T H L E T E ' S &nbsp; P R O F I L E</h3></center>
        <div class="well">
            <img class="profilepic img-rounded" src="/sys_files/img/profile_pic/athlete/{{$athleteData->profile_pic}}" style="margin-left: 3%;box-shadow: 0 0 3px 3px rgba(0,0,0,0.1);" alt="" height="150" width="150"/><br/><br/>
            <div class="row">
                <div class="col-xs-5 col-xs-offset-1"><h5><b>Name: </b>{{strtoupper($athleteData->last_name)}}, {{strtoupper($athleteData->given_name)}} {{strtoupper($athleteData->middlename)}}</h5></div>
                 <div class="col-xs-5 col-xs-offset-1">
                     <h5><b>College Department: </b>{{$athleteData->college_department}}</h5>
                     </div>
            </div>
            <div class="row">
                <div class="col-xs-5 col-xs-offset-1">
                <h5><b>Student ID: </b>{{$athleteData->student_id}}</h5>
                </div>
                </div>
        </div>
        <div class="well">
            <h4><center>P E R S O N A L &nbsp; D A T A</center></h4>
            <hr style="border: 1px solid white;"/>
            <div class="row">
                <h5 class="col-xs-4"><b>Birth Date: </b>{{date_format(date_create(strval($athleteData->birth_day)),'M d,Y')}}</h5>
                <h5 class="col-xs-4"><b>Age :</b>{{(date_diff(date_create(strval(date('Y-m-d'))),date_create($athleteData->birth_day))->y)}}</h5>
                <h5 class="col-xs-4"><b>Gender: </b>{{$athleteData->gender}}</h5>
            </div>
            <div class="row">
                <h5 class="col-xs-6"><b>Birthplace: </b>{{$athleteData->birth_place}}</h5>
                <h5 class="col-xs-6"><b>Home Address: </b>{{$athleteData->home_address}}</h5>
                </div>
                <div class="row">
                    <h5 class="col-xs-4"><b>Nationality: </b>{{$athleteData->nationality}}</h5>
                    <h5 class="col-xs-4"><b>Emergency Address: </b>{{$athleteData->emergency_detailed_address}}</h5>
                    <h5 class="col-xs-4"><b>Civil Status: </b>{{$athleteData->civil_status}}</h5>
                    </div>
                <div class="row">
                    <h5 class="col-xs-4"><b>Mother's Name: </b>{{strtoupper($athleteData->mother_last_name)}}, {{strtoupper($athleteData->mother_first_name)}} {{strtoupper($athleteData->mother_middle_name)}}</h5>
                    <h5 class="col-xs-4"><b>Mother's Nickname: </b>{{$athleteData->mother_nickname}}</h5>
                    <h5 class="col-xs-4"><b>Mother Living: </b>{{($athleteData->mother_living == 0)? 'NO':'YES'}}</h5>
               </div>
                         <div class="row">
                                    <h5 class="col-xs-4"><b>Father's Name: </b>{{strtoupper($athleteData->father_last_name)}}, {{strtoupper($athleteData->father_first_name)}} {{strtoupper($athleteData->father_middle_name)}}</h5>
                                    <h5 class="col-xs-4"><b>Father's Nickname: </b>{{$athleteData->father_nickname}}</h5>
                                    <h5 class="col-xs-4"><b>Father Living: </b>{{($athleteData->father_living == 0)? 'NO':'YES'}}</h5>
                               </div>
                               <div class="row">

                                                                 </div>
                                                                 <div class="row">
                                                               <h5 class="col-xs-4"><b>Guardian: </b>{{$athleteData->guardian}}</h5>
                                                              <h5 class="col-xs-4"><b>Contact Number: </b>{{$athleteData->contact_number}}</h5>
                                                                 <h5 class="col-xs-4"><b>Contact Person: </b>{{$athleteData->contact_person}}</h5>
                                                                 </div>
                            <div class="row">
                                <h5 class="col-xs-4"><b>Passport: </b>{{($athleteData->passport == 0)? 'NO':'YES'}}</h5>
                                <h5 class="col-xs-4"><b>NBI: </b>{{($athleteData->nbi == 0)? 'NO':'YES'}}</h5>
                                <h5 class="col-xs-4"><b>NSO: </b>{{($athleteData->nso == 0)? 'NO':'YES'}}</h5>
                                </div>
                                @if($athleteData->nbi==1)
                                <h5><b>N B I</b></h5>
                                <div class="row">
                                    <h5 class="col-xs-4"><b>Date Apply: </b>{{$athleteData->nbi_date_apply}}</h5>
                                    <h5 class="col-xs-4"><b>Date Issue: </b>{{$athleteData->date_issue}}</h5>
                                    <h5 class="col-xs-4"><b>Date Expire: </b>{{$athleteData->date_expire}}</h5>
                                    </div>
                                    @endif
        </div>
        <div class="well">
            <div class="row">
                <h4>
                    <center>H E A L T H &nbsp; I N F O R M A T I O N</center>
                    </h4>
            </div>
            <hr style="border: 1px solid white;"/>
            <div class="row">
                <h5 class="col-xs-4"><b>Blood Type: </b>{{$athleteData->blood_type}}</h5>
                <h5 class="col-xs-4"><b>Height: </b>{{$athleteData->height}}</h5>
                <h5 class="col-xs-4"><b>Weight: </b>{{$athleteData->weight}}</h5>
                </div>
                <div class="row">
                    <h5 class="col-xs-4"><b>Maintenance Medicine: </b>{{$athleteData->maintenance_meds}}</h5>
                    <h5 class="col-xs-4"><b>Eyeglass: </b>{{($athleteData->eyeglass == 0)? 'NO':'YES'}}</h5>
                    <h5 class="col-xs-4"><b>Contact Lens: </b>{{($athleteData->contact_lens == 0)? 'NO':'YES'}}</h5>
                    </div>
                     <div class="row">
                                        <h5 class="col-xs-4"><b>Braces: </b>{{$athleteData->braces}}</h5>
                                        <h5 class="col-xs-4"><b>Major Operation: </b>{{$athleteData->major_operation}}</h5>
                                        <h5 class="col-xs-4"><b>Medical History: </b>{{$athleteData->medical_history}}</h5>
                                        </div>
       </div>
       <div class="well">
           <div class="row">
             <h4>
                                <center>S P O R T S</center>
                                </h4>
           </div>
           <hr style="border: 1px solid white;"/>
           <div class="row">
               <h5 class="col-xs-4"><b>Team :</b>{{$athleteData->teamName}}</h5>
               <h5 class="col-xs-4"><b>Sport: </b>{{$athleteData->sport}}</h5>
               <h5 class="col-xs-4"><b>Playing Position: </b>{{$athleteData->playing_position}}</h5>
               </div>
               <div class="row">
                   <h5 class="col-xs-4"><b>Recruiter: </b>{{$athleteData->recruited_by}}</h5>
                   <h5 class="col-xs-4"><b>Recruiter Contact: </b>{{$athleteData->recruiter_contact}}</h5>
                   <h5 class="col-xs-4"><b>Playing Status: </b>{{$athleteData->playing_status}}</h5>
                   </div>
           </div>
           </section>
</form>
</div>
    </div>
<form id="edit" method="post" action="{{route('adminUpdateAthlete')}}" enctype="multipart/form-data">
<input type="hidden" name="id" value="{{$athleteData->id}}"/>
<div class="panel-group" id="accordion" style="box-shadow: 0 0 3px 3px rgba(0,0,0,0.3);position:relative;width: 90%;left:5%;">
      <div class="panel panel-primary"  >
        <div class="panel-heading" style="background-color: #0b2644;">
          <h4 class="panel-title">
          <br/>
            <a style="color:white;" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
            <b>Personal Data</b></a>
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
          <div class="panel-body">
          <div class="row">

    <div class="col-xs-12">
    <div class="well">
    <div class="row">
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="@if(isset($athleteData)){{$athleteData->last_name}} @else{{old('last_name')}}@endif"/>
    </div>
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Given Name" name="given_name" value="@if(isset($athleteData)){{$athleteData->given_name}} @else{{old('given_name')}}@endif"/>
    </div>
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="@if(isset($athleteData)){{$athleteData->middle_name}}@else{{old('middle_name')}}@endif"/>
    </div>
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Suffix Name" name="suffix_name" value="@if(isset($athleteData)){{$athleteData->suffix_name}}@else{{old('suffix_name')}}@endif"/>
    </div><hr>
    </div>
    <!--row-->
    <div class="row">
    <div class="col-xs-6">
    <input type="date" class="form-control" name="birth_day" value="@if(isset($athleteData)){{$athleteData->birth_day}}@else{{old('birth_day')}}@endif"/>
    </div>
    <div class="col-xs-6">
    <input type="text" class="form-control" placeholder="Birth Place" name="birth_place" value="@if(isset($athleteData)){{$athleteData->birth_place}}@else{{old('birth_place')}}@endif"/>
    </div><hr>
    </div>
    <!--row-->
    <!--row-->
    <div class="row">
    <div class="col-xs-6">
    <input type="text" class="form-control" placeholder="Nationality" name="nationality" value="@if(isset($athleteData)){{$athleteData->nationality}}@else{{old('nationality')}}@endif"/>
    </div>
    <div class="col-xs-6">
     <label class="radio-inline">
          <input type="radio" @if(isset($athleteData))@if($athleteData->gender == "Male")checked @endif @else checked @endif  name="gender" value="Male">Male
        </label>
        <label class="radio-inline">
          <input type="radio"  @if(isset($athleteData))@if($athleteData->gender == "Female")checked @endif @endif  name="gender" value="Female">Female
        </label>
    </div><hr>
    </div>

    <div class="row">
    <div class="col-xs-12">
    <input type="text" class="form-control" placeholder="Home Address" name="home_address" value="@if(isset($athleteData)){{$athleteData->home_address}}@else{{old('home_address')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-6">
    <input type="text" class="form-control" placeholder="Person in case of emergency" name="contact_person" value="@if(isset($athleteData)){{$athleteData->contact_person}}@else{{old('contact_person')}}@endif"/>
    </div>
    <div class="col-xs-6">
    <input type="text" class="form-control" placeholder="Contact Number" id="maskForm" name="contact_number" value="@if(isset($athleteData)){{$athleteData->contact_number}}@else{{old('contact_number')}}@endif"/>
    </div><hr>
    </div>

    <div class="row">
    <div class="col-xs-6">
    <label class="radio-inline">
          <input type="radio" name="civil_status" @if(isset($athleteData))@if($athleteData->civil_status == "Single")checked @endif @else checked @endif value="Single">Single
        </label>
        <label class="radio-inline">
          <input type="radio" name="civil_status" @if(isset($athleteData))@if($athleteData->civil_status == "Married")checked @endif @endif value="Married">Married
        </label>
        <label class="radio-inline">
          <input type="radio" name="civil_status" @if(isset($athleteData))@if($athleteData->civil_status == "Separated")checked @endif @endif value="Separated">Separated
        </label>
    </div>
    <div class="col-xs-6">
    Blood Type
    <select name="blood_type" class="form-control">
     <option @if(isset($athleteData))@if($athleteData->blood_type == "A")selected @endif @endif>A</option>
      <option @if(isset($athleteData))@if($athleteData->blood_type == "B")selected @endif @endif>B</option>
       <option @if(isset($athleteData))@if($athleteData->blood_type == "AB")selected @endif @endif>AB</option>
        <option @if(isset($athleteData))@if($athleteData->blood_type == "O")selected @endif @endif>O</option>

     </select>
    </div><hr><hr>
    </div>

    <div class="row">
    <div class="col-xs-6">
    <input type="text" class="form-control" placeholder="Health Card Number" name="health_card" value="@if(isset($athleteData)){{$athleteData->health_card}}@else{{old('health_card')}}@endif"/>
    </div>
    <div class="col-xs-6">
    <input type="text" class="form-control" placeholder="Address in Case of Emergency" name="emergency_detailed_address" value="@if(isset($athleteData)){{$athleteData->emergency_detailed_address}}@else{{old('emergency_detailed_address')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-12">
     Stay at dormitory?
      <label class="radio-inline">
          <input type="radio"  @if(isset($athleteData))@if($athleteData->at_dormitory == 1) checked @endif @else checked @endif name="at_dormitory"  value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="at_dormitory" @if(isset($athleteData))@if($athleteData->at_dormitory == 0) checked @endif @endif value="0">No
        </label>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-12">
      Picture
     <input type="hidden" name="MAX_FILE_SIZE" value="2500000000000"/>
    <input type="file" name="profile_pic" class="form-control" value="/sys_files/img/profile_pic/athlete/{{$athleteData->profile_pic}}"/>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-xs-12">

    <b>Father Profile</b>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-xs-3">

    <input type="text" class="form-control" placeholder="Last Name" name="father_last_name" value="@if(isset($athleteData)){{$athleteData->father_last_name}}@else{{old('father_last_name')}}@endif"/>
    </div>

    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Given Name" name="father_given_name" value="@if(isset($athleteData)){{$athleteData->father_given_name}}@else{{old('father_given_name')}}@endif"/>
    </div>
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Middle Name" name="father_middle_name" value="@if(isset($athleteData)){{$athleteData->father_middle_name}}@else{{old('father_middle_name')}}@endif"/>
    </div>
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="NickName" name="father_nickname" value="@if(isset($athleteData)){{$athleteData->father_nickname}}@else{{old('father_nickname')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-12">
     <label class="radio-inline">
          <input type="radio" @if(isset($athleteData))@if($athleteData->father_living == 1) checked @endif @else checked @endif name="father_living" value="1">Living
        </label>
     <label class="radio-inline">
          <input type="radio" name="father_living" @if(isset($athleteData))@if($athleteData->father_living == 0) checked @endif @endif value="0">Deceased
        </label>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-xs-12">

    <b>Mother Profile</b>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-xs-3">

    <input type="text" class="form-control" placeholder="Last Name" name="mother_last_name" value="@if(isset($athleteData)){{$athleteData->mother_last_name}}@else{{old('mother_last_name')}}@endif"/>
    </div>

    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Given Name" name="mother_given_name" value="@if(isset($athleteData)){{$athleteData->mother_given_name}}@else{{old('mother_given_name')}}@endif"/>
    </div>
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="Middle Name" name="mother_middle_name" value="@if(isset($athleteData)){{$athleteData->mother_middle_name}}@else{{old('mother_middle_name')}}@endif"/>
    </div>
    <div class="col-xs-3">
    <input type="text" class="form-control" placeholder="NickName" name="mother_nickname" value="@if(isset($athleteData)){{$athleteData->mother_nickname}}@else{{old('mother_nickname')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-12">
     <label class="radio-inline">
          <input type="radio" @if(isset($athleteData))@if($athleteData->mother_living == 1) checked @endif @else checked @endif name="mother_living">Living
        </label>
     <label class="radio-inline">
          <input type="radio" @if(isset($athleteData))@if($athleteData->mother_living == 0) checked @endif @endif name="mother_living">Deceased
        </label>
    </div><hr>
    </div>


    <div class="row">
    <div class="col-xs-6">
    <textarea name="medical_history" placeholder="Any Medical History (Please input comma if many)"class="form-control">@if(isset($athleteData)){{$athleteData->medical_history}}@else{{old('medical_history')}}@endif
    </textarea>
    </div>
    <div class="col-xs-6">
    <textarea name="major_operation" placeholder="Any Major Operation (input comma if many)" class="form-control">@if(isset($athleteData)){{$athleteData->major_operation}}@else{{old('major_operation')}}@endif
    </textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-6">Vaccination/Immunization
    <label class="radio-inline">
          <input type="radio" name="vaccination" @if(isset($athleteData))@if($athleteData->vaccination == 1) checked @endif @else checked @endif value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="vaccination" @if(isset($athleteData))@if($athleteData->vaccination == 0) checked @endif @endif value="0">No
        </label>
    </div>
    <div class="col-xs-6">&nbsp
    <textarea name="maintenance_meds" placeholder="Any Maintenance Medicine (input comma if many)" class="form-control">@if(isset($athleteData)){{$athleteData->maintenance_meds}}@else{{old('maintenance_meds')}}@endif
    </textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-6">Do You wear eyeglasses
    <label class="radio-inline">
          <input type="radio" name="eyeglass" @if(isset($athleteData))@if($athleteData->eyeglass == 1) checked @endif @else checked @endif value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="eyeglass" value="0" @if(isset($athleteData))@if($athleteData->eyeglass == 0) checked @endif @endif>No
        </label>
    </div>
    <div class="col-xs-6">
    Do You wear contact lens
    <label class="radio-inline">
          <input type="radio" @if(isset($athleteData))@if($athleteData->contact_lens == 1) checked @endif @else checked @endif name="contact_lens" value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="contact_lens" @if(isset($athleteData))@if($athleteData->contact_lens == 0) checked @endif @endif value="0">No
        </label>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-6">
    <textarea name="braces"  placeholder="Any Dental Braces or other braces" class="form-control">@if(isset($athleteData)){{$athleteData->braces}}@else{{old('bracecs')}}@endif</textarea>
    </div>
    <div class="col-xs-6">
    <textarea name="family_history" placeholder="Any family members that have history in heart,thyroid,highblood,cancer" class="form-control">@if(isset($athleteData)){{$athleteData->family_history}}@else{{old('family_history')}}@endif</textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-6">&nbsp
    <input type="text" name="recruited_by" placeholder="Who recruited you (Coach,Manager,Team mate etc.)" class="form-control" value="@if(isset($athleteData)){{$athleteData->recruited_by}}@else{{old('recruited_by')}}@endif"/>
    </div>
    <div class="col-xs-6">&nbsp
    <input type="text" name="recruiter_contact" placeholder="Recruiters Contact Number" class="form-control" value="@if(isset($athleteData)){{$athleteData->recruiter_contact}}@else{{old('recruiter_contact')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-xs-12">&nbsp
    <textarea name="learn_sport_program" placeholder="How did you learn about the sports program" class="form-control">@if(isset($athleteData)){{$athleteData->learn_sport_program}}@else{{old('learn_sport_program')}}@endif</textarea>
    </div><hr>
    </div>


    </div>
    </div>
</div>
<!--End -->

	  </div>
    </div>
  </div>
  <div class="panel panel-primary">
     <div class="panel-heading" style="background-color: #0b2644;" >
      <h4 class="panel-title">
      <br/>
        <a style="color:white;" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        <b>Academics</b></a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
	  <div class="row">
<div class="col-xs-6">
 <input type="text" name="grade" class="form-control" placeholder="Grade/Course" value="@if(isset($athleteData)){{$athleteData->grade}}@else{{old('grade')}}@endif"/>
</div>

<div class="col-xs-6">
 <select name="college_department" class="form-control">
 <option value="CCS" @if(isset($athleteData))@if($athleteData->college_department == "CCS") selected @endif @endif>CCS</option>
  <option value="CBA" @if(isset($athleteData))@if($athleteData->college_department == "CBA") selected @endif @endif>CBA</option>
   <option value="COE" @if(isset($athleteData))@if($athleteData->college_department == "COE") selected @endif @endif>COE</option>
    <option value="CEAS" @if(isset($athleteData))@if($athleteData->college_department == "CEAS") selected @endif @endif>CEAS</option>
	 <option value="COA" @if(isset($athleteData))@if($athleteData->college_department == "COA") selected @endif @endif>COA</option>
	  <option value="COD" @if(isset($athleteData))@if($athleteData->college_department == "COD") selected @endif @endif>COD</option>
	   <option>CON</option>
 </select>
</div><hr>
</div>
<div class="row">
<div class="col-xs-6">
 <input type="text" class="form-control" placeholder="High School Section" name="high_school_section" value="@if(isset($athleteData)){{$athleteData->high_school_section}}@else{{old('high_school_section')}}@endif"/>
</div>
<div class="col-xs-6">
 <input type="text" class="form-control" placeholder="High School Adviser" name="high_school_adviser" value="@if(isset($athleteData)){{$athleteData->high_school_adviser}}@else{{old('high_school_adviser')}}@endif"/>
</div><hr>
</div>
<div class="row">
<div class="col-xs-12">
  <select name="expected_school_year_graduate" class="form-control">
 <option>2016-2017</option>
  <option>2017-2018</option>
   <option>2018-2019</option>
    <option>2019-2020</option>
	 <option>2021-2022</option>
	  <option>2022-2023</option>
	   <option>2023-2024</option>
 </select>
</div><hr>
</div>
	  </div></div>
    </div>

  <div class="panel panel-primary" >
    <div class="panel-heading" style="background-color: #0b2644;">
      <h4 class="panel-title">
      <br/>
        <a style="color:white;" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
            <b>Sport</b></a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
	  <div class="row">
<div class="col-xs-4">
<label class="radio-inline">
      <input type="radio" value="Team Captain" name="team_pos">Team Captain
    </label>
	<label class="radio-inline">
      <input type="radio" value="Co-Captain" name="team_pos">Co-Captain
    </label>
	<label class="radio-inline">
      <input type="radio" value="Team Member" name="team_pos">Team Member
    </label>
</div>
<div class="col-xs-2">
    <select name="sport" class="form-control">
        @foreach($ListOfSport as $sport)
            <option @if(isset($athleteData))@if($athleteData->sport == $sport->sport_name) selected @endif @endif value="{{$sport->sport_name}}">{{$sport->sport_name}}</option>
        @endforeach
    </select>
</div>
<div class="col-xs-3">
<input type="text" class="form-control" placeholder="Height (Cm)" name="height" value="@if(isset($athleteData)){{$athleteData->height}}@else{{old('height')}}@endif"/>
</div>
<div class="col-xs-3">
<input type="text" class="form-control" placeholder="Weight (Kg)" name="weight" value="@if(isset($athleteData)){{$athleteData->weight}}@else{{old('weight')}}@endif"/>
</div><hr>
</div>

<div class="row">
<div class="col-xs-6">
UAAP Playing Years :<input type="Number" class="form-control" min="1" max="5" name="uaap_playing_years" value="@if(isset($athleteData)){{$athleteData->uaap_playing_years}}@else{{old('uaap_playing_years')}}@endif"/>
</div>
<div class="col-xs-6">
Eligible Until :<input type="Number" class="form-control" min="2016" max="2022" name="eligible_until"/>

</div><hr><hr>
</div>
<div class="row">
<div class="col-xs-12">
<input type="text" class="form-control" placeholder="Playing Position" name="playing_position"/>
<select name="team_type">
       <option @if(isset($athleteData))@if($athleteData->team_type == "Team A") selected @endif @endif value="Team A">Team A</option>
       <option @if(isset($athleteData))@if($athleteData->team_type == "Team B") selected @endif @endif value="Team B">Team B</option>
</select>
</div><hr>
</div>

<div class="row">
<div class="col-xs-12">
Achievement
<textarea class="form-control" name="achievement">@if(isset($athleteData)){{$athleteData->achivement}}@else{{old('achievement')}}@endif</textarea>

</div><hr>
</div>
<div class="row">
<div class="col-xs-6">
Do you have any disciplinary action?
 <label class="radio-inline">

      <input type="radio" @if(isset($athleteData))@if($athleteData->sanction_no == 1) checked @endif @else checked @endif name="sanction" value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="sanction" @if(isset($athleteData))@if($athleteData->sanction_no == 0) checked @endif @endif value="0">No
    </label>
</div>
<div class="col-xs-6">

 <textarea name="sanction_remarks" placeholder="Please explain further" class="form-control">@if(isset($athleteData)){{$athleteData->sanction_remarks}}@else{{old('sanction_remarks')}}@endif</textarea>
</div><hr>
</div>
<div class="row">
<div class="col-xs-6">
Did you submitted all required documents to registrar?
 <label class="radio-inline">

      <input type="radio" name="submit_required_documents" @if(isset($athleteData))@if($athleteData->submit_required_documents == 1) checked @endif @else checked @endif value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="submit_required_documents" @if(isset($athleteData))@if($athleteData->submit_required_documents == 0) checked @endif @endif value="0">No
    </label>
</div>
<!--<div class="col-xs-6">

 <label class="radio-inline">

      <input type="radio" name="team_yes">UAAP team
    </label>
 <label class="radio-inline">
      <input type="radio" name="team_no">Training team
    </label>
</div>--><hr>
</div>
<div class="row">
<div class="col-xs-4">
Do you stay at dormitory?
 <label class="radio-inline">

      <input type="radio" name="at_dormitory" @if(isset($athleteData))@if($athleteData->at_dormitory == 1) checked @endif @else checsked  @endif value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="at_dormitory" @if(isset($athleteData))@if($athleteData->at_dormitory == 0) checked @endif @endif value="0">No
    </label>
</div>
<div class="col-xs-4">

 <input type="text" name="room_number" class="form-control" placeholder="Room Number" value="@if(isset($athleteData)){{$athleteData->room_number}}@else{{old('room_number')}}@endif"/>
</div>
<div class="col-xs-4">

 <input type="text" name="room_mates" class="form-control" placeholder="Room Mates" value="@if(isset($athleteData)){{$athleteData->room_mates}}@else{{old('room_mates')}}@endif"/>
</div><hr>
</div>
<div class="row">
<div class="col-xs-6">
Do you go home during weekends?
 <label class="radio-inline">

      <input type="radio" name="weekends_stay" value="1" @if(isset($athleteData))@if($athleteData->weekend_stay == 1) checked @endif @else checked  @endif>Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="weekends_stay" value="0" @if(isset($athleteData))@if($athleteData->at_dormitory == 0) checked @endif @endif>No
    </label>
</div>
<div class="col-xs-6">
<input type="text" name="guardian" class="form-control" placeholder="Guardian If Any" value="@if(isset($athleteData)){{$athleteData->guardian}}@endif"/>
</div><hr>
</div>
<div class="row">
<div class="col-xs-12">
Do you have NSO?
 <label class="radio-inline">

      <input type="radio" name="nso" @if(isset($athleteData))@if($athleteData->nso == 1) checked @endif @else checked  @endif value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="nso" @if(isset($athleteData))@if($athleteData->nso == 0) checked @endif    @endif value="0">No
    </label>
</div><hr>
</div>
<div class="row">
<div class="col-xs-4">&nbsp
<input type="text" name="passport_number" class="form-control" placeholder="Passport Number" value="@if(isset($athleteData)){{$athleteData->passport_number}}@else{{old('passport_number')}}@endif"/>
</div>
<div class="col-xs-4">Date of Expiration
<input type="date" name="date_expire" class="form-control" value="@if(isset($athleteData)){{$athleteData->date_expire}}@else{{old('date_expire')}}@endif"/>
</div>
<div class="col-xs-4">Date of Issue
<input type="date" name="date_issue" class="form-control" value="@if(isset($athleteData)){{$athleteData->date_issue}}@else{{old('date_issue')}}@endif"/>
</div><hr>
</div>
<!-- -->
</div>
</div>
</div>
</div>
<br/>
<div class="btn btn-success col-xs-3 col-xs-offset-4" id="update" onclick="$('#edit').submit();"><b><span class="glyphicon glyphicon-edit"></span></b>&nbsp;Update Profile</div>
<br/><br/>

</form>
@endif
</div>
@stop