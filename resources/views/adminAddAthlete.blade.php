@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
     <script src="/addons/js/bootstrap.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
        $('.nav').children('li:nth-child(2)').addClass('active');
    });
</script>
@stop
@section('contents')
 <div class="row">
        <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
            <center><h3 style="color: #ffffff;"><b>A D D &nbsp;&nbsp; A T H L E T E</b></h3></center>
        </div>
    </div>
    <br/>
            <h5><b style="cursor:pointer;" title="" data-toggle="popover" data-trigger="hover" data-content="Go back to athlete's list"><a href="{{route('adminviewAthlete')}}"><span class="glyphicon glyphicon-home"></span> Home </a></b>&nbsp;&nbsp; > &nbsp;&nbsp; <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;<u>Add Athlete</u> </h5>
    <br/>
<div class="row panel">
    <h4>&nbsp;&nbsp;&nbsp;<b><span class="glyphicon glyphicon-save"></span></b>&nbsp;Athlete Creation</h4>
    <h5>&nbsp;&nbsp;&nbsp;<b id="step1" style="cursor:pointer;color:#0b2644;" data-toggle="popover" title="" data-trigger="hover" data-content="Fill up the athletes profile">Step 1</b>&nbsp;&nbsp;&nbsp; >&nbsp;&nbsp;&nbsp; <b id="step2" href="@if(Session::has('addAthlete')){{route('adminAddAthlete2')}}@endif" style="cursor:pointer;"  data-toggle="popover" title="" data-trigger="hover" data-content="Fill up the athletes credentials as a user">Step 2</b></h5>
<form method="post" action="{{route('adminAddAthletes')}}" enctype="multipart/form-data">

<br/>
<!--Accordion-->
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

    <div class="col-sm-12">
    <div class="well">
    <div class="row">
    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->last_name}} @else{{old('last_name')}}@endif"/>
    </div>
    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Given Name" name="given_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->given_name}} @else{{old('given_name')}}@endif"/>
    </div>
    <div class="col-sm-3">
    <input type="text" class="form-control"placeholder="Middle Name" name="middle_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->middle_name}}@else{{old('middle_name')}}@endif"/>
    </div>
    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Suffix Name" name="suffix_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->suffix_name}}@else{{old('suffix_name')}}@endif"/>
    </div><hr>
    </div>
    <!--row-->
    <div class="row">
    <div class="col-sm-6">
    <input type="date" class="form-control" name="birth_day" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->birth_day}}@else{{old('birth_day')}}@endif"/>
    </div>
    <div class="col-sm-6">
    <input type="text" class="form-control" placeholder="Birth Place" name="birth_place" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->birth_place}}@else{{old('birth_place')}}@endif"/>
    </div><hr>
    </div>
    <!--row-->
    <!--row-->
    <div class="row">
    <div class="col-sm-6">
    <input type="text" class="form-control" placeholder="Nationality" name="nationality" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->nationality}}@else{{old('nationality')}}@endif"/>
    </div>
    <div class="col-sm-6">
     <label class="radio-inline">
          <input type="radio" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->gender == "Male")checked @endif @else checked @endif  name="gender" value="Male">Male
        </label>
        <label class="radio-inline">
          <input type="radio"  @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->gender == "Female")checked @endif @endif  name="gender" value="Female">Female
        </label>
    </div><hr>
    </div>

    <div class="row">
    <div class="col-sm-12">
    <input type="text" class="form-control" placeholder="Home Address" name="home_address" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->home_address}}@else{{old('home_address')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">
    <input type="text" class="form-control" placeholder="Person in case of emergency" name="contact_person" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->contact_person}}@else{{old('contact_person')}}@endif"/>
    </div>
    <div class="col-sm-6">
    <input type="text" class="form-control" placeholder="Contact Number" id="maskForm" name="contact_number" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->contact_number}}@else{{old('contact_number')}}@endif"/>
    </div><hr>
    </div>

    <div class="row">
    <div class="col-sm-6">
    <label class="radio-inline">
          <input type="radio" name="civil_status" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->civil_status == "Single")checked @endif @else checked @endif value="Single">Single
        </label>
        <label class="radio-inline">
          <input type="radio" name="civil_status" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->civil_status == "Married")checked @endif @endif value="Married">Married
        </label>
        <label class="radio-inline">
          <input type="radio" name="civil_status" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->civil_status == "Separated")checked @endif @endif value="Separated">Separated
        </label>
    </div>
    <div class="col-sm-6">
    Blood Type
    <select name="blood_type" class="form-control">
     <option @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->blood_type == "A")selected @endif @endif>A</option>
      <option @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->blood_type == "B")selected @endif @endif>B</option>
       <option @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->blood_type == "AB")selected @endif @endif>AB</option>
        <option @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->blood_type == "O")selected @endif @endif>O</option>

     </select>
    </div><hr><hr>
    </div>

    <div class="row">
    <div class="col-sm-6">
    <input type="text" class="form-control" placeholder="Health Card Number" name="health_card" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->health_card}}@else{{old('health_card')}}@endif"/>
    </div>
    <div class="col-sm-6">
    <input type="text" class="form-control" placeholder="Address in Case of Emergency" name="emergency_detailed_address" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->emergency_detailed_address}}@else{{old('emergency_detailed_address')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">
     Stay at dormitory?
      <label class="radio-inline">
          <input type="radio"  @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->at_dormitory == 1) checked @endif @else checked @endif name="at_dormitory"  value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="at_dormitory" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->at_dormitory == 0) checked @endif @endif value="0">No
        </label>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">

     <input type="hidden" name="MAX_FILE_SIZE" value="2500000000000"/>
      <b>Profile Picture: </b>
                                                        <div class="controls">
                                                                                                                <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="">
                                                                                                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="/sys_files/img/user.jpg"></div>
                                                                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                                                                    <div>
                                                                                                                        <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span> <input type="file" name="profile_pic" class="form-control" value="{{old('profile_pic')}}"/></span>
                                                                                                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                                                                                    </div>

                                                    </div>

    </div><hr>
    </div>
    <div class="row">

    <div class="col-sm-12">

    <b>Father Profile</b>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-sm-3">

    <input type="text" class="form-control" placeholder="Last Name" name="father_last_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->father_last_name}}@else{{old('father_last_name')}}@endif"/>
    </div>

    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Given Name" name="father_given_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->father_given_name}}@else{{old('father_given_name')}}@endif"/>
    </div>
    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Middle Name" name="father_middle_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->father_middle_name}}@else{{old('father_middle_name')}}@endif"/>
    </div>
    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="NickName" name="father_nickname" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->father_nickname}}@else{{old('father_nickname')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">
     <label class="radio-inline">
          <input type="radio" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->father_living == 1) checked @endif @else checked @endif name="father_living" value="1">Living
        </label>
     <label class="radio-inline">
          <input type="radio" name="father_living" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->father_living == 0) checked @endif @endif value="0">Deceased
        </label>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-sm-12">

    <b>Mother Profile</b>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-sm-3">

    <input type="text" class="form-control" placeholder="Last Name" name="mother_last_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->mother_last_name}}@else{{old('mother_last_name')}}@endif"/>
    </div>

    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Given Name" name="mother_given_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->mother_given_name}}@else{{old('mother_given_name')}}@endif"/>
    </div>
    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Middle Name" name="mother_middle_name" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->mother_middle_name}}@else{{old('mother_middle_name')}}@endif"/>
    </div>
    <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="NickName" name="mother_nickname" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->mother_nickname}}@else{{old('mother_nickname')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">
     <label class="radio-inline">
          <input type="radio" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->mother_living == 1) checked @endif @else checked @endif name="mother_living">Living
        </label>
     <label class="radio-inline">
          <input type="radio" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->mother_living == 0) checked @endif @endif name="mother_living">Deceased
        </label>
    </div><hr>
    </div>


    <div class="row">
    <div class="col-sm-6">
    <textarea name="medical_history" placeholder="Any Medical History (Please input comma if many)"class="form-control">@if(Session::has('addAthlete')){{Session::get('addAthlete')->medical_history}}@else{{old('medical_history')}}@endif
    </textarea>
    </div>
    <div class="col-sm-6">
    <textarea name="major_operation" placeholder="Any Major Operation (input comma if many)" class="form-control">@if(Session::has('addAthlete')){{Session::get('addAthlete')->major_operation}}@else{{old('major_operation')}}@endif
    </textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">Vaccination/Immunization
    <label class="radio-inline">
          <input type="radio" name="vaccination" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->vaccination == 1) checked @endif @else checked @endif value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="vaccination" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->vaccination == 0) checked @endif @endif value="0">No
        </label>
    </div>
    <div class="col-sm-6">&nbsp
    <textarea name="maintenance_meds" placeholder="Any Maintenance Medicine (input comma if many)" class="form-control">@if(Session::has('addAthlete')){{Session::get('addAthlete')->maintenance_meds}}@else{{old('maintenance_meds')}}@endif
    </textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">Do You wear eyeglasses
    <label class="radio-inline">
          <input type="radio" name="eyeglass" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->eyeglass == 1) checked @endif @else checked @endif value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="eyeglass" value="0" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->eyeglass == 0) checked @endif @endif>No
        </label>
    </div>
    <div class="col-sm-6">
    Do You wear contact lens
    <label class="radio-inline">
          <input type="radio" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->contact_lens == 1) checked @endif @else checked @endif name="contact_lens" value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="contact_lens" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->contact_lens == 0) checked @endif @endif value="0">No
        </label>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">
    <textarea name="braces"  placeholder="Any Dental Braces or other braces" class="form-control">@if(Session::has('addAthlete')){{Session::get('addAthlete')->braces}}@else{{old('bracecs')}}@endif</textarea>
    </div>
    <div class="col-sm-6">
    <textarea name="family_history" placeholder="Any family members that have history in heart,thyroid,highblood,cancer" class="form-control">@if(Session::has('addAthlete')){{Session::get('addAthlete')->family_history}}@else{{old('family_history')}}@endif</textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">&nbsp
    <input type="text" name="recruited_by" placeholder="Who recruited you (Coach,Manager,Team mate etc.)" class="form-control" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->recruited_by}}@else{{old('recruited_by')}}@endif"/>
    </div>
    <div class="col-sm-6">&nbsp
    <input type="text" name="recruiter_contact" placeholder="Recruiters Contact Number" class="form-control" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->recruiter_contact}}@else{{old('recruiter_contact')}}@endif"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">&nbsp
    <textarea name="learn_sport_program" placeholder="How did you learn about the sports program" class="form-control">@if(Session::has('addAthlete')){{Session::get('addAthlete')->learn_sport_program}}@else{{old('learn_sport_program')}}@endif</textarea>
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
<div class="col-sm-6">
 <input type="text" name="grade" class="form-control" placeholder="Grade/Course" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->grade}}@else{{old('grade')}}@endif"/>
</div>

<div class="col-sm-6">
 <select name="college_department" class="form-control">
 <option value="CCS" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->college_department == "CCS") selected @endif @endif>CCS</option>
  <option value="CBA" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->college_department == "CBA") selected @endif @endif>CBA</option>
   <option value="COE" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->college_department == "COE") selected @endif @endif>COE</option>
    <option value="CEAS" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->college_department == "CEAS") selected @endif @endif>CEAS</option>
	 <option value="COA" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->college_department == "COA") selected @endif @endif>COA</option>
	  <option value="COD" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->college_department == "COD") selected @endif @endif>COD</option>
	   <option>CON</option>
 </select>
</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
 <input type="text" class="form-control" placeholder="High School Section" name="high_school_section" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->high_school_section}}@else{{old('high_school_section')}}@endif"/>
</div>
<div class="col-sm-6">
 <input type="text" class="form-control" placeholder="High School Adviser" name="high_school_adviser" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->high_school_adviser}}@else{{old('high_school_adviser')}}@endif"/>
</div><hr>
</div>
<div class="row">
<div class="col-sm-12">
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
<div class="col-sm-4">
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
<div class="col-sm-2">
    <select name="sport" class="form-control">
        @foreach($ListOfSport as $sport)
            <option @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->sport == $sport->sport_name) selected @endif @endif value="{{$sport->sport_name}}">{{$sport->sport_name}}</option>
        @endforeach
    </select>
</div>
<div class="col-sm-3">
<input type="text" class="form-control" placeholder="Height (Cm)" name="height" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->height}}@else{{old('height')}}@endif"/>
</div>
<div class="col-sm-3">
<input type="text" class="form-control" placeholder="Weight (Kg)" name="weight" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->weight}}@else{{old('weight')}}@endif"/>
</div><hr>
</div>

<div class="row">
<div class="col-sm-6">
UAAP Playing Years :<input type="Number" class="form-control" min="1" max="5" name="uaap_playing_years" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->uaap_playing_years}}@else{{old('uaap_playing_years')}}@endif"/>
</div>
<div class="col-sm-6">
Eligible Until :<input type="Number" class="form-control" min="2016" max="2022" name="eligible_until"/>

</div><hr><hr>
</div>
<div class="row">
<div class="col-sm-12">
<input type="text" class="form-control" placeholder="Playing Position" name="playing_position"/>
<select name="team_type">
       <option @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->team_type == "Team A") selected @endif @endif value="Team A">Team A</option>
       <option @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->team_type == "Team B") selected @endif @endif value="Team B">Team B</option>
</select>
</div><hr>
</div>

<div class="row">
<div class="col-sm-12">
Achievement
<textarea class="form-control" name="achievement">@if(Session::has('addAthlete')){{Session::get('addAthlete')->achivement}}@else{{old('achievement')}}@endif</textarea>

</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
Do you have any disciplinary action?
 <label class="radio-inline">

      <input type="radio" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->sanction_no == 1) checked @endif @else checked @endif name="sanction" value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="sanction" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->sanction_no == 0) checked @endif @endif value="0">No
    </label>
</div>
<div class="col-sm-6">

 <textarea name="sanction_remarks" placeholder="Please explain further" class="form-control">@if(Session::has('addAthlete')){{Session::get('addAthlete')->sanction_remarks}}@else{{old('sanction_remarks')}}@endif</textarea>
</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
Did you submitted all required documents to registrar?
 <label class="radio-inline">

      <input type="radio" name="submit_required_documents" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->submit_required_documents == 1) checked @endif @else checked @endif value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="submit_required_documents" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->submit_required_documents == 0) checked @endif @endif value="0">No
    </label>
</div>
<!--<div class="col-sm-6">

 <label class="radio-inline">

      <input type="radio" name="team_yes">UAAP team
    </label>
 <label class="radio-inline">
      <input type="radio" name="team_no">Training team
    </label>
</div>--><hr>
</div>
<div class="row">
<div class="col-sm-4">
Do you stay at dormitory?
 <label class="radio-inline">

      <input type="radio" name="at_dormitory" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->at_dormitory == 1) checked @endif @else checsked  @endif value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="at_dormitory" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->at_dormitory == 0) checked @endif @endif value="0">No
    </label>
</div>
<div class="col-sm-4">

 <input type="text" name="room_number" class="form-control" placeholder="Room Number" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->room_number}}@else{{old('room_number')}}@endif"/>
</div>
<div class="col-sm-4">

 <input type="text" name="room_mates" class="form-control" placeholder="Room Mates" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->room_mates}}@else{{old('room_mates')}}@endif"/>
</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
Do you go home during weekends?
 <label class="radio-inline">

      <input type="radio" name="weekends_stay" value="1" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->weekend_stay == 1) checked @endif @else checked  @endif>Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="weekends_stay" value="0" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->at_dormitory == 0) checked @endif @endif>No
    </label>
</div>
<div class="col-sm-6">
<input type="text" name="guardian" class="form-control" placeholder="Guardian If Any" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->guardian}}@endif"/>
</div><hr>
</div>
<div class="row">
<div class="col-sm-12">
Do you have NSO?
 <label class="radio-inline">

      <input type="radio" name="nso" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->nso == 1) checked @endif @else checked  @endif value="1">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="nso" @if(Session::has('addAthlete'))@if(Session::get('addAthlete')->nso == 0) checked @endif    @endif value="0">No
    </label>
</div><hr>
</div>
<div class="row">
<div class="col-sm-4">&nbsp
<input type="text" name="passport_number" class="form-control" placeholder="Passport Number" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->passport_number}}@else{{old('passport_number')}}@endif"/>
</div>
<div class="col-sm-4">Date of Expiration
<input type="date" name="date_expire" class="form-control" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->date_expire}}@else{{old('date_expire')}}@endif"/>
</div>
<div class="col-sm-4">Date of Issue
<input type="date" name="date_issue" class="form-control" value="@if(Session::has('addAthlete')){{Session::get('addAthlete')->date_issue}}@else{{old('date_issue')}}@endif"/>
</div><hr>
</div>
<!-- -->
</div>
</div>
</div>
 <ul class="error">
      @if(Session::has('errors'))
       @foreach(Session::get('errors') as $err)
        <li style="margin-left:1%; display:inline-block;color: red;"><b>● </b>&nbsp;{{$err}}</li>
       @endforeach
       @endif
       </ul>
</div>

    <div class="col-sm-4 col-sm-offset-4">
	  <input type="submit" class="btn btn-primary form-control" value="+ Add Athlete"/>
	  </div>

</form>
</div>
@stop