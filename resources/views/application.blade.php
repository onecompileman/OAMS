@extends('template')
<!DOCTYPE>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">
     <script src="/addons/js/jquery.js"></script><script src="/addons/js/bootstrap.js"></script>

 <style>
 ul li{
 color:red;
 }
 ul{
 list-style: none;
 }
       nav{
         position:relative;
         width: 100%;
         background-color: #005599;
         padding-top: .7%;
         padding-bottom:.5% ;
       }
       nav li a{
               color:#ffce42;

       }
    nav li{
        padding: 8px;
        font-size: 16px;
        position:relative;
        display: inline;
        margin-left: 5%;
        margin-right: 5%;
        border-radius: 5px;
    }
    a:visited{
        color: #ffce42;
    }
    nav li:hover{
        background-color: #0076d7;
    }
     nav li:hover a{
            color:white;
         text-decoration: none;
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
    color:green;
}
#form{
position: relative;
 width: 60%;
 left: 20%;
}
.promote .modals{
    background-color: rgba(11,38,68,0.6);
}
.promote{
    background-image: url('/sys_files/img/homescreen/application/back.jpg');
    background-size: 105% 100%;

}
.mot img,h3{
    transition: 0.5s linear;
}

.mot:hover img,h3{
    transform: scale(1.2);
}
.on{
    background-color: #213978;
}
 </style>
 <script>
    $(document).ready(function(){
         $('.nav').children('li').removeClass('on');
         $('.nav').children('li:nth-child(6)').addClass('on');
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
</head>
<body>

      @section('contents')
      <br><br>
       <div class="row" style="padding-bottom: 2%;padding-top: 2%;background-color:#3498db; ">
              <div class="title">
                    <center> <h2 style="color:white;"><b>A P P L I C A T I O N</b></h2> </center>
              </div>
          </div>
      <div class="promote">
      <div class="modals">
      <div class="row">
           <center> <h1 style="color:white;">Be Part Of Our Expanding Community</h1></center>
          <center>
                <h3 style="display: inline;color:rgb(255,255,255);">We Encourage Grade 12 students who aspires to be part of our team to send <span style="color:#22cff6;" class="glyphicon glyphicon-file"></span> us, your informaion.</h3>
          </center>

      </div>
      <br/><br/>
      <div class="body">

       <hr style="width:780px;position: relative; top:450px; border: 15px solid #0b2644;transform: rotate(90deg);"/>

     <div class="row mot">

            <div class="col-sm-5 col-sm-offset-1">
                <div class="well" style="background-color: rgba(255,255,255,0.7);">
                <div class="row">
                <div class="col-sm-5">
                    <img style="display: inline;" src="/sys_files/img/homescreen/application/1.jpg" height="150px" width="150px" class="img-circle"/>
                   </div>

                     <img height="60px" width="60px" src="/sys_files/img/homescreen/application/1.png"><h3 style="display: inline;"><b>W I N</b></h3>
                        <br><br/>
                    <p style="display: inline; font-family: Consolas;" >
                            Feel the thrill and happiness of wining, experience NU bulldogs finest teams and coaches to lead you to victory.
                    </p>
                </div>
                </div>
            </div>

     </div>
     <div class="row mot">

                 <div class="col-sm-5 col-sm-offset-6">
                     <div class="well"  style="background-color: rgba(255,255,255,0.7);">
                     <div class="row">
                     <div class="col-sm-5">
                         <img style="display: inline;" src="/sys_files/img/homescreen/application/2.jpg" height="150px" width="150px" class="img-circle"/>
                        </div>

                          <img height="60px" width="60px" src="/sys_files/img/homescreen/application/2.png"><h3 style="display: inline;"><b>C O M P E T E</b></h3>
                             <br><br/>
                         <p style="display: inline; font-family: Consolas;" >
                                 Fight your way with different UAAP teams, accept defeat and cherish each victory.
                         </p>
                     </div>
                     </div>
                 </div>

          </div>
           <div class="row mot">

                      <div class="col-sm-5 col-sm-offset-1">
                          <div class="well" style="background-color: rgba(255,255,255,0.7);">
                          <div class="row">
                          <div class="col-sm-5">
                              <img style="display: inline;" src="/sys_files/img/homescreen/application/3.jpg" height="150px" width="150px" class="img-circle"/>
                             </div>

                               <img height="60px" width="60px" src="/sys_files/img/homescreen/application/3.png"><h3 style="display: inline;"><b>T R A I N</b></h3>
                                  <br><br/>
                              <p style="display: inline; font-family: Consolas;" >
                                     Train yourself physically, using our well maintained gym.
                              </p>
                          </div>
                          </div>
                      </div>
</div>
 <div class="row mot">

                 <div class="col-sm-5 col-sm-offset-6">
                     <div class="well"  style="background-color: rgba(255,255,255,0.7);">
                     <div class="row">
                     <div class="col-sm-5">
                         <img style="display: inline;" src="/sys_files/img/homescreen/application/4.jpg" height="150px" width="150px" class="img-circle"/>
                        </div>

                          <img height="60px" width="60px" src="/sys_files/img/homescreen/application/4.png"><h3 style="display: inline;"><b>L E A R N</b></h3>
                             <br><br/>
                         <p style="display: inline; font-family: Consolas;" >
                                 Learn from your seniors and coaches to enhance further your ability.
                         </p>
                     </div>
                     </div>
                 </div>

          </div>
               </div>
          </div>
          </div>
     <hr style="border:1.5px solid #0b2644;"/>
     <div class="row">
        <form id="form" class="form-group col-sm-8" method="post" action="{{route('addApplicant')}}" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2500000">
        <input type="hidden" name="pending" value=1>
                <div class="panel panel-default ">
                    <div class="panel-heading" style="background-color: #0b2644;">
                      <h4 class="panel-title">
                        <center><a style="cursor:pointer;color:#22cff6" ><h4><b><span class="glyphicon glyphicon-file"></span></b>
                        Applicant's Data</h4></a></center>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                      <div class="panel-body">
                	  <div class="row">

                <div class="col-sm-12">
                <div class="well">
                <div class="row">
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Last Name"name="last_name"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Given Name"name="given_name"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Middle Name"name="middle_name"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Suffix Name"name="suffix_name"/>
                </div><hr>
                </div>
                <!--row-->
                <div class="row">
                <div class="col-sm-6">
                <input type="date" class="form-control" name="bday"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Birth Place"name="birthplace"/>
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
                </div>
                  <div class="col-sm-12">
                                <input type="email"class="form-control"placeholder="Email"name="email"/>
                                </div>
                <hr>
                </div>
                <div class="row">
               <hr>
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
                <select name="blood_type" class="form-control">
                 <option>A</option>
                  <option>B</option>
                   <option>AB</option>
                    <option>O</option>

                 </select>
                </div><hr><hr>
                </div>

                <div class="row">

                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Address in Case of Emergency"name="address_emergency"/>
                </div><hr>
                </div>
                <div class="row">
                <div class="col-sm-12">

                </div><hr>
                </div>
                <div class="row">
                <div class="col-sm-12">
                 <input type="hidden" name="MAX_FILE_SIZE" value="2500000000000000000"/>
                  <b>Profile Picture: </b>
                                                                   <div class="controls">
                                                                                                                           <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="">
                                                                                                                               <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="/sys_files/img/user.jpg"></div>
                                                                                                                               <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                                                                               <div>
                                                                                                                                   <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>                <input type="file" name="profile_pic" class="form-control"/>
</span>
                                                                                                                                   <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                                                                                               </div>

                                                               </div>
                                                               </div>
                <br/>
                Youtube Video Link:(Optional for board games, video that shows you playing your sports for us to evaluate)
                <input type="url" name="ytlink" class="form-control" placeholder="www.youtube.com/myvideo"/>
                </div><hr>
                </div>
                <div class="row">

                <div class="col-sm-12">

                <b>Father Profile</b>
                </div><hr>
                </div>
                <div class="row">

                <div class="col-sm-6">

                <input type="text"class="form-control"placeholder="Last Name"name="father_last_name"/>
                </div>

                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Given Name"name="father_given_name"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Middle Name"name="father_middle_name"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="NickName"name="father_suffix_name"/>
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

                <div class="col-sm-6">

                <input type="text"class="form-control"placeholder="Last Name"name="mother_last_name"/>
                </div>

                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Given Name"name="mother_given_name"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="Middle Name"name="mother_middle_name"/>
                </div>
                <div class="col-sm-6">
                <input type="text"class="form-control"placeholder="NickName"name="mother_suffix_name"/>
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

               <div class="col-sm-5">
                   <select name="sport" class="form-control">
                       @foreach($ListOfSport as $sport)
                           <option value="{{$sport->sport_name}}">{{$sport->sport_name}}</option>
                       @endforeach
                   </select>
               </div>
               <div class="col-sm-6">
               <input type="text"class="form-control"placeholder="Height (Cm)"name="height"/>
               </div>
               <div class="col-sm-6">
               <input type="text"class="form-control"placeholder="Weight (Kg)"name="weight"/>
               </div><hr>
               </div>


               <div class="row">
               <div class="col-sm-12">
               <input type="text"class="form-control"placeholder="Playing Position"name="playing_pos"/>

               </div><hr>
               </div>

               <div class="row">
               <div class="col-sm-12">
               Achievement
               <textarea class="form-control"name="achievement"></textarea>

               </div><hr>
               </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <center>
                <input type="submit" class="btn btn-primary">
                <input type="reset" class="btn btn-danger">
                </center>

<div class="row">
      <ul class="error">
              @if(isset($Error))
               @foreach($Error as $err)
                <li>{{$err}}</li>
               @endforeach
               </ul>
               @endif

</div>
     </div>
    </form>
</div>


 @stop
@if(isset($Added))
   <center> <div class="success-message">
    <h3 class="success">{{$Added}}</h3>
    </div></center>
@endif
