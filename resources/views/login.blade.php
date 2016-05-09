<!DOCTYPE>
<html>
<head>

      <title>Online Athlete Management</title>
     <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">
    <script type="text/javascript" src="/addons/js/jquery.js"></script>
    <script>
        $(document).ready(function(){
            @if(!isset($errors))
            $('.log').toggle();
            @else
                $('#showLogin').children('h4:first-child').html("Hide Login Panel");
            @endif
            $('#showLogin').click(function(){
                $('.log').fadeToggle(1000);
                $(this).children('h4:first-child').html(($(this).children('h4:first-child').html() == "Show Login Panel")? "Hide Login Panel":"Show Login Panel");
            });

        });
    </script>
     <style>
        #showLogin{
            cursor:pointer;
        }
        .panel-heading h4{
            position:relative;
            margin-left: 2%;
        }
        .log{
        position:relative;
        top: 150px;
        left: 27.5%;
        width: 45%;
        box-shadow: 0px 0px 10px 10px rgba(0,0,0,0.4);
        }
        body{
            background-color: rgb(200,200,200);
            overflow-x: hidden;
        }
        .ss{
        position: relative;
        right: -30%;
        }
        a h4{
            text-decoration: underline;
        }
     </style>
</head>
<body >
    <a id="showLogin">
        <h4>Show Login Panel</h4>
        </a>
    <div>
        <div class="panel panel-primary log">
        <div class="panel-heading head">
           <b><center> <span class="glyphicon glyphicon-log-in"></span><h4 style="display: inline;">Login</h4></center></b>
        </div>
        <div class="panel-body">


        {!!Form::open(['url'=>route('loginInto'),'class'=>'form form-group','method'=>'post'])!!}
         <div class="container">
         {!!Form::token()!!}
         <br>
         <div class="row">
         <div class="col-sm-1">

          {!!Form::label('usernames','Username:')!!}</div> <div class="col-sm-5">
            <div class="input-group">
            <span class="input-group-addon glyphicon glyphicon-user" id="1"></span>
           {!!Form::text('username','',['class'=>'form-control','aria-describeby'=>'1','placeholder'=>'Enter Your Username'])!!}
            </div>
          </div>
            </div>
                <br><br>
            <div class="row">
            <div class="col-sm-1">
          {!!Form::label('passwords','Password:')!!}</div><div class="col-sm-5">
          <div class="input-group"><span class="input-group-addon glyphicon glyphicon-lock" id="1"></span>
          {!!Form::password('password',['class'=>'form-control','aria-descibeby'=>'1','placeholder'=>'Enter Your Password'])!!}</div>
          </div>
           <br><br><br/>
           <div class="row">
            <div class="col-md-3 col-md-offset-2">
          {!!Form::submit('LOGIN',['class'=>'btn btn-primary ss'])!!}
            </div>
           </div>
           @if(isset($errorss))
                       <h5 style="color:red">{{($errorss)}}</h5>
                       @endif
          </div>
         </div>
         {!!Form::close()!!}
         </div>


           </div>
           </div>
</body>
</html>