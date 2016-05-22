<html>
    <head>
        <link rel="stylesheet" href="/addons/css/bootstrap.css"/>
        <style>
            .invoice h4,h5{
                color: black;
            }
              .warning{
                                transition: 0.5s linear;
                                font-size: 80px;color: #950000;
                            }
                            .warning:hover{
                                font-size: 90px;
                            }
        </style>
    </head>
    <body onload="@if($exists)window.print();@endif">
        @if(!$exists)
        <div class="row">
                <br/>
                               <center><h1 class="warning" ><span class="glyphicon glyphicon-ban-circle"></span></h1></center>
                                <center><h3>There is no athlete exists!</h3></center>
        </div>
        @else
        <section class="invoice">
            <div class="row">
                    <center><img src="/sys_files/img/nu.png" alt="" height="70" width="70"/></center>
                    <center><h4><b>NATIONAL UNIVERSITY</b></h4></center>
                       <center>
                                                    <h5><b>551 M. F. Jhocson St. Sampaloc, Manila 1008</b></h5>
                                                    </center>
                    <center><h5>Athletics Department</h5></center>
            </div>
               <div class="row">
                                <div class="col-xs-offset-1">
                                    <h5><b>Date: </b>{{date('m/d/Y')}}</h5>
                                </div>
                                </div>
                                <br/>
                                <center><h2><span class="glyphicon glyphicon-user"></span>&nbsp; A T H L E T E ' S &nbsp; P R O F I L E</h2></center>
                                <hr style="border: 1px solid black;"/>
                <div class="">
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
                <br/><br/>
                <div class="">
                    <h4><center>P E R S O N A L &nbsp; D A T A</center></h4>

                    <hr style="border: 1px solid black;"/>
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
                <br/><br/><br/><br/>
                <div class="">
                    <div class="row">
                        <h4>
                            <center>H E A L T H &nbsp; I N F O R M A T I O N</center>
                            </h4>
                    </div>
                    <hr style="border: 1px solid black;"/>
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
               <br/><br/>
               <div class="">
                   <div class="row">
                     <h4>
                                        <center>S P O R T S</center>
                                        </h4>
                   </div>
                   <hr style="border: 1px solid black;"/>
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
                   @endif
    </body>
</html>