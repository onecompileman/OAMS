@extends('coach')
@section('css')
<style>
.succ{float:right;}
.success{
    color:green;
}
ul li{
color:red;
}
ul{
list-style: none;
}
.user-credentials{
position: absolute;
top: 200px;
left: 35%;
z-index: 12;
}
#modal{
position: absolute;
background-color: rgba(0,0,0,0.6);
left: -2%;
top:-4%;
z-index: 11;
width:105%;
height: 1000px;
}
.success-message{
position: absolute;
z-index: 10;
top:300px;
left: 30%;
    background-color: white;
    box-shadow: 0px 0px 10px 10px rgba(0,0,0,0.6);
    border-radius: 5px;
    padding: 10px;
}

</style>

<script>
    $(document).ready(function(){
    $.scrollLock = ( function scrollLockClosure() {
        'use strict';

        var $html      = $( 'html' ),
            // State: unlocked by default
            locked     = false,
            // State: scroll to revert to
            prevScroll = {
                scrollLeft : $( window ).scrollLeft(),
                scrollTop  : $( window ).scrollTop()
            },
            // State: styles to revert to
            prevStyles = {},
            lockStyles = {
                'overflow-y' : 'scroll',
                'position'   : 'fixed',
                'width'      : '100%'
            };

        // Instantiate cache in case someone tries to unlock before locking
        saveStyles();

        // Save context's inline styles in cache
        function saveStyles() {
            var styleAttr = $html.attr( 'style' ),
                styleStrs = [],
                styleHash = {};

            if( !styleAttr ){
                return;
            }

            styleStrs = styleAttr.split( /;\s/ );

            $.each( styleStrs, function serializeStyleProp( styleString ){
                if( !styleString ) {
                    return;
                }

                var keyValue = styleString.split( /\s:\s/ );

                if( keyValue.length < 2 ) {
                    return;
                }

                styleHash[ keyValue[ 0 ] ] = keyValue[ 1 ];
            } );

            $.extend( prevStyles, styleHash );
        }

        function lock() {
            var appliedLock = {};

            // Duplicate execution will break DOM statefulness
            if( locked ) {
                return;
            }

            // Save scroll state...
            prevScroll = {
                scrollLeft : $( window ).scrollLeft(),
                scrollTop  : $( window ).scrollTop()
            };

            // ...and styles
            saveStyles();

            // Compose our applied CSS
            $.extend( appliedLock, lockStyles, {
                // And apply scroll state as styles
                'left' : - prevScroll.scrollLeft + 'px',
                'top'  : - prevScroll.scrollTop  + 'px'
            } );

            // Then lock styles...
            $html.css( appliedLock );

            // ...and scroll state
            $( window )
                .scrollLeft( 0 )
                .scrollTop( 0 );

            locked = true;
        }

        function unlock() {
            // Duplicate execution will break DOM statefulness
            if( !locked ) {
                return;
            }

            $html.attr( 'style', $( '<x>' ).css( prevStyles ).attr( 'style' ) || '' );
            $( window )
                .scrollLeft( prevScroll.scrollLeft )
                .scrollTop(  prevScroll.scrollTop );

            locked = false;
        }

        return function scrollLock( on ) {
            if( arguments.length ) {
                if( on ) {
                    lock();
                }
                else {
                    unlock();
                }
            }
            // Otherwise, toggle
            else {
                if( locked ){
                    unlock();
                }
                else {
                    lock();
                }
            }
        };
    }() );
        <?php if(!isset($_SESSION)) session_start(); ?>
        @if(isset($_SESSION['addedAthlete']))
            $.scrollLock(true);
        @else
            $.scrollLock(false);
        @endif
        var x=1;
        setInterval(function(){
            x++;
            if(x==3)
                $('.success-message').animate({opacity:'0'},1000);



            if(x==4)
             $('.success-message').toggle() ;

        },1000);
    }    );
</script>
@stop
@section('contents')
 @if(isset($_SESSION['addedAthlete']))
<div id="modal"></div>
@endif
<form method="post" action="{{route('addingAthlete')}}" enctype="multipart/form-data">


<!--Accordion-->
<div class="panel-group" id="accordion">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a style="color:#f7ce42" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
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
    <input type="text"class="form-control"placeholder="Last Name"name="last_name"/>
    </div>
    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="Given Name"name="given_name"/>
    </div>
    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="Middle Name"name="middle_name"/>
    </div>
    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="Suffix Name"name="suffix_name"/>
    </div><hr>
    </div>
    <!--row-->
    <div class="row">
    <div class="col-sm-6">
    <input type="date" class="form-control" name="birth_day"/>
    </div>
    <div class="col-sm-6">
    <input type="text"class="form-control"placeholder="Birth Place"name="birth_place"/>
    </div><hr>
    </div>
    <!--row-->
    <!--row-->
    <div class="row">
    <div class="col-sm-6">
    <input type="text"class="form-control"placeholder="Nationality"name="nationality"/>
    </div>
    <div class="col-sm-6">
     <label class="radio-inline">
          <input type="radio" checked name="gender" value="Male">Male
        </label>
        <label class="radio-inline">
          <input type="radio" name="gender" value="Female">Female
        </label>
    </div><hr>
    </div>

    <div class="row">
    <div class="col-sm-12">
    <input type="text"class="form-control"placeholder="Home Address"name="home_address"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">
    <input type="text"class="form-control"placeholder="Person in case of emergency"name="contact_person"/>
    </div>
    <div class="col-sm-6">
    <input type="text"class="form-control"placeholder="Contact Number"id="maskForm"name="contact_number"/>
    </div><hr>
    </div>

    <div class="row">
    <div class="col-sm-6">
    <label class="radio-inline">
          <input type="radio" name="civil_status" checked value="Single">Single
        </label>
        <label class="radio-inline">
          <input type="radio" name="civil_status" value="Married">Married
        </label>
        <label class="radio-inline">
          <input type="radio" name="civil_status" value="Seperated">Seperated
        </label>
    </div>
    <div class="col-sm-6">
    Blood Type
    <select name="blood_type"class="form-control">
     <option>A</option>
      <option>B</option>
       <option>AB</option>
        <option>O</option>

     </select>
    </div><hr><hr>
    </div>

    <div class="row">
    <div class="col-sm-6">
    <input type="text"class="form-control"placeholder="Health Card Number"name="health_card"/>
    </div>
    <div class="col-sm-6">
    <input type="text"class="form-control"placeholder="Address in Case of Emergency"name="emergency_detailed_address"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">
     Stay at dormitory?
      <label class="radio-inline">
          <input type="radio" checked name="at_dormitory" value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="at_dormitory" value="0">No
        </label>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">
      Picture
     <input type="hidden" name="MAX_FILE_SIZE" value="2500000000000"/>
    <input type="file" name="profile_pic" class="form-control"/>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-sm-12">

    <b>Father Profile</b>
    </div><hr>
    </div>
    <div class="row">

    <div class="col-sm-3">

    <input type="text"class="form-control"placeholder="Last Name"name="father_last_name"/>
    </div>

    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="Given Name"name="father_given_name"/>
    </div>
    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="Middle Name"name="father_middle_name"/>
    </div>
    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="NickName"name="father_nickname"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">
     <label class="radio-inline">
          <input type="radio" checked name="father_living">Living
        </label>
     <label class="radio-inline">
          <input type="radio" name="father_living">Deceased
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

    <input type="text"class="form-control"placeholder="Last Name"name="mother_last_name"/>
    </div>

    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="Given Name"name="mother_given_name"/>
    </div>
    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="Middle Name"name="mother_middle_name"/>
    </div>
    <div class="col-sm-3">
    <input type="text"class="form-control"placeholder="NickName"name="mother_nickname"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">
     <label class="radio-inline">
          <input type="radio" checked name="mother_living">Living
        </label>
     <label class="radio-inline">
          <input type="radio" name="mother_living">Deceased
        </label>
    </div><hr>
    </div>


    <div class="row">
    <div class="col-sm-6">
    <textarea name="medical_history"placeholder="Any Medical History (Please input comma if many)"class="form-control"/>
    </textarea>
    </div>
    <div class="col-sm-6">
    <textarea name="major_operation"placeholder="Any Major Operation (input comma if many)"class="form-control"/>
    </textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">Vaccination/Immunization
    <label class="radio-inline">
          <input type="radio" name="vaccination" checked value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="vaccination" value="0">No
        </label>
    </div>
    <div class="col-sm-6">&nbsp
    <textarea name="maintenance_meds"placeholder="Any Maintenance Medicine (input comma if many)"class="form-control"/>
    </textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">Do You wear eyeglasses
    <label class="radio-inline">
          <input type="radio" checked name="eyeglass" value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="eyeglass" value="0">No
        </label>
    </div>
    <div class="col-sm-6">
    Do You wear contact lens
    <label class="radio-inline">
          <input type="radio" checked name="contact_lens" value="1">Yes
        </label>
     <label class="radio-inline">
          <input type="radio" name="contact_lens" value="0">No
        </label>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">
    <textarea name="braces"placeholder="Any Dental Braces or other braces"class="form-control"></textarea>
    </div>
    <div class="col-sm-6">
    <textarea name="family_history"placeholder="Any family members that have history in heart,thyroid,highblood,cancer"class="form-control"></textarea>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-6">&nbsp
    <input type="text" name="recruited_by"placeholder="Who recruited you (Coach,Manager,Team mate etc.)"class="form-control"/>
    </div>
    <div class="col-sm-6">&nbsp
    <input type="text" name="recruiter_contact"placeholder="Recruiters Contact Number"class="form-control"/>
    </div><hr>
    </div>
    <div class="row">
    <div class="col-sm-12">&nbsp
    <textarea name="learn_sport_program"placeholder="How did you learn about the sports program"class="form-control"></textarea>
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
    <div class="panel-heading">
      <h4 class="panel-title">
        <a style="color:#f7ce42" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        <b>Academics</b></a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
	  <div class="row">
<div class="col-sm-6">
 <input type="text"class="form-control"placeholder="Grade/Course"/>
</div>

<div class="col-sm-6">
 <select name="college_department"class="form-control">
 <option>CCS</option>
  <option>CBA</option>
   <option>COE</option>
    <option>CEAS</option>
	 <option>COA</option>
	  <option>COD</option>
	   <option>CON</option>
 </select>
</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
 <input type="text"class="form-control"placeholder="High School Section"name="high_school_section"/>
</div>
<div class="col-sm-6">
 <input type="text"class="form-control"placeholder="High School Adviser"name="high_school_adviser"/>
</div><hr>
</div>
<div class="row">
<div class="col-sm-12">
  <select name="expected_school_year_graduate"class="form-control">
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

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a style="color:#f7ce42" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
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
            <option value="{{$sport->sport_name}}">{{$sport->sport_name}}</option>
        @endforeach
    </select>
</div>
<div class="col-sm-3">
<input type="text"class="form-control"placeholder="Height (Cm)"name="height"/>
</div>
<div class="col-sm-3">
<input type="text"class="form-control"placeholder="Weight (Kg)"name="weight"/>
</div><hr>
</div>

<div class="row">
<div class="col-sm-6">
UAAP Playing Years :<input type="Number"class="form-control"min="1"max="5"name="uaap_playing_years"/>
</div>
<div class="col-sm-6">
Eligible Until :<input type="Number"class="form-control"min="2016"max="2022"name="eligible_until"/>

</div><hr><hr>
</div>
<div class="row">
<div class="col-sm-12">
<input type="text"class="form-control"placeholder="Playing Position"name="playing_position"/>
<select name="team_type">
       <option>Team A</option>
       <option>Team B</option>
</select>
</div><hr>
</div>

<div class="row">
<div class="col-sm-12">
Achievement
<textarea class="form-control"name="achievement"></textarea>

</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
Do you have any disciplinary action?
 <label class="radio-inline">

      <input type="radio" name="sanction_yes">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="sanction_no">No
    </label>
</div>
<div class="col-sm-6">

 <textarea name="sanction_remarks"placeholder="Please explain further"class="form-control"></textarea>
</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
Did you submitted all required documents to registrar?
 <label class="radio-inline">

      <input type="radio" name="submitted_yes">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="submitted_no">No
    </label>
</div>
<div class="col-sm-6">

 <label class="radio-inline">

      <input type="radio" name="team_yes">UAAP team
    </label>
 <label class="radio-inline">
      <input type="radio" name="team_no">Training team
    </label>
</div><hr>
</div>
<div class="row">
<div class="col-sm-4">
Do you stay at dormitory?
 <label class="radio-inline">

      <input type="radio" name="stay_yes">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="stay_no">No
    </label>
</div>
<div class="col-sm-4">

 <input type="text"name="room_number"class="form-control"placeholder="Room Number"/>
</div>
<div class="col-sm-4">

 <input type="text"name="room_mates"class="form-control"placeholder="Room Mates"/>
</div><hr>
</div>
<div class="row">
<div class="col-sm-6">
Do you go home during weekends?
 <label class="radio-inline">

      <input type="radio" name="weekend_stay_yes">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="weekend_stay_no">No
    </label>
</div>
<div class="col-sm-6">
<input type="text"name="guardian"class="form-control"placeholder="Guardian If Any"/>
</div><hr>
</div>
<div class="row">
<div class="col-sm-12">
Do you have NSO?
 <label class="radio-inline">

      <input type="radio" name="nso_yes">Yes
    </label>
 <label class="radio-inline">
      <input type="radio" name="nso_no">No
    </label>
</div><hr>
</div
<div class="row">
<div class="col-sm-4">&nbsp
<input type="text"name="passport_number"class="form-control"placeholder="Passport Number"/>
</div>
<div class="col-sm-4">Date of Expiration
<input type="date"name="date_expire"class="form-control"/>
</div>
<div class="col-sm-4">Date of Issue
<input type="date"name="date_issue"class="form-control"/>
</div><hr>
</div>
<!-- -->
</div>
</div>
</div>
 @if(isset($_SESSION['addedAthlete']))
<div class="user-credentials">
    <div class="panel panel-primary">
        <div class="panel-heading"><center><h3 style="color:white;">User Credentials</h3></center></div>
        <div class="panel-body form">
            <input class="form-control" type="text" name="username" placeholder="Username">
            <br><input class="form-control" type="password" name="password" placeholder="Password">
            Mac Address of the user(if many seperate by comma(,))
            <textarea class="form-control" name="Mac"></textarea>
            <center><br><input class="btn btn-success" type="submit" name="submit" value="OK"></center>
        </div>
    </div>
</div>
@endif
	  <input type="submit" class="btn-success form-control" value="+ Add Athlete"/>
	  <ul class="error">
      @if(isset($Error))
       @foreach($Error as $err)
        <li>{{$err}}</li>
       @endforeach
       </ul>
</div>





</form>

@stop
@section('popup')
@elseif(isset($Added))
   <center> <div class="success-message">
    <h3 class="success">{{$Name}}, is {{$Added}}</h3>
    </div></center>
@endifif(isset($Added))
   <center> <div class="success-message">
    <h3 class="success">{{$Name}}, is {{$Added}}</h3>
    </div></center>
@endif
@stop