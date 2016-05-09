@extends('coach')
@section('css')
<style>
.success{
color:green;
}
ul li{
color:red;
}
ul{
list-style: none;
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
var x=1;
        setInterval(function(){
            x++;
            if(x==3)
                $('.success-message').animate({opacity:'0'},1000);



            if(x==4)
             $('.success-message').toggle() ;

        },1000);
</script>
@stop
@section('contents')
<?php if(!isset($_SESSION)) session_start();
       $editMode=false;
       if(isset($editable)){
                  $editMode=true;

                  $class=($editable)? "form-control":"form-control-static";
       }
       else $class="form-control";
 ?>

<div class="container-fluid">
    <form class="form-group" action="{{route('addSchedule')}}" method="post">
        <div class="panel panel-primary">
            <div class="panel-heading"><center><h4>Schedule of Game/Traning</h4></center>   </div>
                 <div class="panel-body">
           <div class="well">
            <div class="row">
                <h4>Date and Time</h4>
                <div class="col-sm-5">
                Date of Training/Game: <input class="{{$class}}" type="date" name="date_of"@if(isset($sID)) value="{{$sID->date_of}}"@endif>
                 </div>
                 <div class="col-sm-5">
                   Time of Training/Game: <input class="{{$class}}" type="time" name="time_of" @if(isset($sID))value="{{$sID->time_of}}"@endif>
                 </div>
            </div>
            </div>
            <div class="well">
            <div class="row">
            <h4>Training/Game Details</h4>
            <div class="col-sm-3">
            Type
                 <select class="form-control" name="type"><option @if(isset($sID)) @if($sID->type=="Training") selected @endif @endif>Training</option><option  @if(isset($sID)) @if($sID->type=="Game") selected @endif @endif>Game</option></select>
                 </div>
                 <div class="col-sm-3">
                 Venue
                 <input type="text" class="{{$class}}" name="venue" @if(isset($sID))value="{{$sID->venue}}"@endif>
                 </div>
                 <div class="col-sm-3">
                 Team Type
                  <select class="{{$class}}" name="Teamtype"><option  @if(isset($sID)) @if($sID->type=="Team A") selected @endif @endif>Team A</option><option  @if(isset($sID)) @if($sID->type=="Team B") selected @endif @endif>Team B</option></select>
                  </div>
             </div>

              <br><br>
             <div class="row">
                <div class="col-sm-10">
                  <input type="hidden" value="{{$_SESSION['user_info']->user_id}}" name="user_id">
                 <input type="hidden"  value="{{$_SESSION['user_info']->team_id}}" name="team_id">
                 Title
                  <input type="text" class="{{$class}}" name="title" @if(isset($sID)) value=" {{$sID->title}}" @endif>

                 </div>
              </div>

              <br><br>

             </div>
                <div class="row">
                                @if($editMode)
                                    @if($editable)
                                    <input type="hidden" name="sID" value="{{explode('/',$_SERVER['PHP_SELF'])[count(explode('/',$_SERVER['PHP_SELF']))-1]}}">
                                          <center><input style="width: 30%" name='submit' type="submit" class="form-control btn btn-success" value="update"><input style="width: 30%" name='submit' type="submit" class="form-control btn btn-danger" value="delete"></center>
                                     @else
                                      <center><input style="width: 50%" name='submit' type="submit" class="form-control btn btn-danger" value="back"></center>

                                    @endif
                                @else
                              <center><input style="width: 50%" name='submit' type="submit" class="form-control btn btn-primary" value="add"></center>
                                @endif
                              </div>
       </div>
       <ul class="error">
             @if(isset($Error))
              @foreach($Error as $err)
               <li>{{$err}}</li>
              @endforeach
              </ul>
              @endif
        </div>


   </form>
   </div>




@stop

@section('popup')
@if(isset($Added))
   <center> <div class="success-message">
    <h3 class="success">{{$Added[0]}}</h3>
    </div></center>
@endif
@stop