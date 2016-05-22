@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
     <script src="/addons/js/bootstrap.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
            var errorUser=false;
                $('[data-toggle="popover"]').popover();
                var usernames = {@if(isset($usernameList))
                                @for($x=0;$x<(count($usernameList)-1);$x++)
                                   "{{$usernameList[$x]->username}}",
                                @endfor
                                    "{{$usernameList[count($usernameList)-1]}}"
                                @endif
                };
                $('#username').keyup(function(){
                       $('#usercom').html((errorUser=(usernames.indexOf($(this).val())!=-1))? 'Username Exists':'');
                });
                $('$sends').submit(function(e){
                        e.preventDefault();
                       if(!errorUser) $('#ff').submit();
                });
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
        <h5>&nbsp;&nbsp;&nbsp;<b href="@if(Session::has('addAthlete')){{route('adminAddAthlete')}}@endif" style="cursor:pointer;color:#0b2644;" data-toggle="popover" title="" data-trigger="hover" data-content="Fill up the athletes profile">Step 1</b>&nbsp;&nbsp;&nbsp; >&nbsp;&nbsp;&nbsp; <b style="cursor:pointer;"  data-toggle="popover" title="" data-trigger="hover" data-content="Fill up the athletes credentials as a user">Step 2</b></h5>
        <br/><br/>
        <div class="panel-primary" style="position: relative;width: 80%;left: 10%;box-shadow: 0 0 3px 3px rgba(0,0,0,0.3);">
            <div class="panel-heading" style="background-color:#0b2644;">
            <h4><b title="" style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-content="This will serve as the athletes user credentials in logging in to the site"><span class="glyphicon glyphicon-info-sign"></span></b>&nbsp;&nbsp;&nbsp; Athlete's User Credentials</h4>
            </div>
            <div class="panel-body">
                    <form class="form-group" id="ff" action="{{route('adminAddAthleteForReal')}}" method="post" enctype="multipart/form-data">
                           <input class="form-control" type="text" name="username" placeholder="Athlete's Username" value="{{old('username')}}" id="username"/><br/>
                           <h5 id="usercom" style="color: red;"></h5>
                           <input class="form-control" type="password" name="password"  placeholder="Athlete's Password" value="{{old('password  ')}}"/><br/>
                           <textarea placeholder="Mac Addresses" class="form-control" name="Mac" id="" cols="30" rows="8">{{old('Mac')}}</textarea><br/>
                          <div class="col-sm-offset-5"><input class="btn btn-primary" type="submit" value="Submit" id="sends"/></div>
                    </form>
                    <ul style="list-style: none;">
                    @if(isset($errors))
                    @foreach($errors as $err)
                        <li style="color: red;"><b>{{$err}}</b></li>
                    @endforeach
                    @endif
                    </ul>
            </div>
            </div>
    </div>
@stop