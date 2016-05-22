<!DOCTYPE>
<html>
<head>
      <title>Online Athlete Management</title>
     <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">
    <script type="text/javascript" src="/addons/js/jquery.js"></script>
         <script src="/addons/js/bootstrap.js"></script>

    <script>
        $(document).ready(function(){
            @if(!isset($errors))
            $('.log').toggle();
            @else
                $('#showLogin').children('h6:first-child').html('<span class="glyphicon glyphicon-eye-close"></span>');
            @endif
            $('#showLogin').click(function(){
                $('.log').fadeToggle(1000);
                $(this).children('h6:first-child').html(($(this).children('h6:first-child').html() == '<span class="glyphicon glyphicon-eye-open"></span>')? '<span class="glyphicon glyphicon-eye-close"></span>':'<span class="glyphicon glyphicon-eye-open"></span>');
            });
            $('#text').click(function(){
                var colors = ['#3498db','#22cff6','#f7ce42','#ffffff','#cd5129','#cd0a9d','#00f33b'];
                $(this).css({color:''+colors[parseInt((Math.random() * 7))]+''});
            });

        });
        function changeText(){

        }
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
        top: 120px;
        left: 30%;
        width: 40%;
        box-shadow: 0px 0px 3px 3px rgba(0,0,0,0.2);
        }
        body{
            background-color: #f1f4f7 ;
            <?php $image = ['/sys_files/img/homescreen/about/back.jpg','/sys_files/img/homescreen/about/back2.jpg','/sys_files/img/homescreen/application/back.jpg','/sys_files/img/homescreen/application/1.jpg','/sys_files/img/homescreen/application/2.jpg','/sys_files/img/homescreen/application/4.jpg'];
                  $img = $image[rand(0,(count($image)-1))];
             ?>
            background-image: url('{{$img}}');
            background-size: 100% 100%;
            background-repeat: repeat;
            overflow-x: hidden;
        }
        .ss{
        position: relative;
        right: -30%;
        }
        a h4{
            text-decoration: underline;
        }
        #modal{
            background-color: rgba(0,0,0,0.3);
            position: absolute;
            height: 100%;
            width: 100%;
        }
        #text{
            color:white;
            cursor: pointer;
            text-shadow:0 0 5px rgba(0,0,0,0.5);
            position: absolute;
            top: 260px;
            text-align: center;
            width: 100%;
        }
        #text h1{
        font-size: 70px;
        }
     </style>
</head>
<body >
<div id="modal">
    <div id="showLogin" style="color:white;">
        <h6>Show Login Panel</h6>
        </div>
    <div>
        <div id="text">
            <center><h1><b>W E &nbsp; M A K E  &nbsp; D I F F E R E N C E</b></h1></center>
        </div>
        <div class="panel panel-default log">
        <div class="panel-heading head" style="background-color: white;">
           <b><center><h3 style="display: inline;"><b>L O G I N</b></h3></center></b>
        </div>
        <div class="panel-body">


        {!!Form::open(['url'=>route('loginInto'),'class'=>'form form-group','method'=>'post'])!!}
         <div class="container-fluid">
         {!!Form::token()!!}
         <br><br/>
         <div class="row">
         <div class="col-sm-12">
            <div class="input-group" style="height: 40px;">
            <span class="input-group-addon" id="1"><span class="glyphicon glyphicon-user"></span></span>
           {!!Form::text('username','',['class'=>'form-control','aria-describeby'=>'1','placeholder'=>'Enter Your Username','style'=>'height:40px;'])!!}
            </div>
          </div>
            </div>
             <br><br/>
            <div class="row">
           <div class="col-sm-12">
          <div class="input-group" style="height: 40px;"><span class="input-group-addon " id="2"><span class="glyphicon glyphicon-lock"></span></span>
          {!!Form::password('password',['class'=>'form-control','aria-descibeby'=>'2','placeholder'=>'Enter Your Password','style'=>'height:40px;'])!!}</div>
          </div>
           <br><br><br/>
           <div class="row">
           <br/>
         <button class="btn btn-info col-sm-6 col-sm-offset-3" type="submit"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; LOGIN</button>
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
           </div>
</body>
</html>