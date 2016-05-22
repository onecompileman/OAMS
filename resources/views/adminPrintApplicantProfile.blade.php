
<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="stylesheet" href="/addons/css/bootstrap.css"/>
    <style>
        h1{
          transition: 0.5s linear;
        }
        h1:hover{
            transform: scale(1.2);
            color:darkred;
        }
    </style>
</head>
<body @if(count($applicant) > 0)onload="window.print()"@endif>
    @if(count($applicant) == 0)
        <div style="position:relative;top:160px;">
            <center><h1 style="font-size: 140px;"><b><span class="glyphicon glyphicon-ban-circle"></span></b></h1></center>
            <center><h2><b>No applicant exists!</b></h2></center>
        </div>

    @else
        <div class="container-fluid">
                                    <div class="row well">
                                   <div class="row">
                                        <div class="col-xs-3 col-xs-offset-1"><img class="img-thumbnail" src="/sys_files/img/profile_pic/applicant/{{$applicant[0]->profile_pic}}" alt="" style="width: 150px;height: 150px;"/><br/><center>Profile Picture</center></div>
        
                                   </div><br/><br/>
                                    <hr/>
                                   <br/><br/>
                                             <div class="col-xs-4"><b>Firstname: </b>{{$applicant[0]->given_name}}</div><div class="col-xs-4"><b>Middlename: </b>{{$applicant[0]->middle_name}}</div><div class="col-xs-4"><b>Lastname: </b>{{$applicant[0]->last_name}}</div><br/>
        <br/>
                                        <br><div class="col-xs-3"><b>Birthdate: </b>{{$applicant[0]->bday}}</div><div class="col-xs-3"><b>Gender: </b>{{$applicant[0]->gender}}</div><div class="col-xs-3"><b>Age: </b>{{date_diff(date_create(strval(date('Y-m-d'))),date_create(strval($applicant[0]->bday)))->y}} yrs old</div><div class="col-xs-3"><b>Civil Status:</b>{{$applicant[0]->civil_status}}</div>
                                       <br> <br/><br/><div class="col-xs-7"><b>Address: </b>{{$applicant[0]->home_address}}</div><div class="col-xs-5"><b>Birthplace:</b>{{$applicant[0]->birthplace}}</div>
                                        <br/><br/><br>
                                         <div class="col-xs-3"><b>Nationality: </b>{{$applicant[0]->nationality}}</div><div class="col-xs-3"><b>Blood Type:</b>{{$applicant[0]->blood_type}}</div><div class="col-xs-3"><b>Height: </b>{{$applicant[0]->height}}</div><div class="col-xs-3"><b>Weight: </b><{{$applicant[0]->weight}}/div>
                                           <br/><br/><br>
                                           <div class="col-xs-4"><b>Mother's Firstname: </b>{{$applicant[0]->mother_given_name}}</div><div class="col-xs-4"><b>Mother's Middlename:</b>{{$applicant[0]->mother_middle_name}}</div><div class="col-xs-4"><b>Mother's Lastname: </b>{{$applicant[0]->mother_last_name}}</div><br/>
                                          <br> <br/><div class="col-xs-4"><b>Father's Firstname: </b>{{$applicant[0]->father_given_name}}</div><div class="col-xs-4"><b>Father's Middlename:</b>{{$applicant[0]->father_middle_name}}</div><div class="col-xs-4"><b>Father's Lastname: </b>{{$applicant[0]->father_last_name}}</div>
                                            <br/><br/><br>
                                            <div class="col-xs-4"><b>Sport: </b>{{$applicant[0]->sport}}</div><div class="col-xs-4"><b>Playing pos: </b>{{$applicant[0]->playing_pos}}</div>
                                            <br/><br/><br>
                                            <div class="col-xs-5"><b>Email: </b>{{$applicant[0]->email}}</div><div class="col-xs-5"><b>Youtube Link: </b>{{$applicant[0]->ytlink}}</div>
                                            <br/><br/><br>
                                    </div>
                                </div>
    @endif
</body>
</html>