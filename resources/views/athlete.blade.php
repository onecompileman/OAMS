<!DOCTYPE>
<html>
<head>
     <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">
     <script src="/addons/js/jquery.js"></script><script src="/addons/js/bootstrap.js"></script>

     @yield ("css")
     <style>

           nav{
                 position:relative;
                 width: 100%;
                 background-color: #005599;
                 padding-top: .7%;
                 padding-bottom:.4% ;
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
            nav span{
             color:#ffce42;
            }
            nav li:hover{
                background-color: #0076d7;
            }
             nav li:hover a{
                    color:white;
                 text-decoration: none;
                }
                .content{
                box-shadow: 0px 0px 10px 10px rgba(0,0,0,0.6);
                }
                .s{position:absolute;
                    top:0;
                    left: 7%;
                }
     </style>
</head>
<body bgcolor="#5f9ea0">

        <div class="container s">
            <div class="content">
            <img src="/sys_files/img/cover.jpg" width="100%">
         <nav><?php if(!isset($_SESSION))
                               session_start();?>
                 <ul>
                    <li><a href="{{route('athleteSchedule')}}">Schedule</a></li>

                      <li class="dropdown">
                               <a href="#" class="dropdown-toggle dLabel" data-toggle="dropdown" role="button" aria-expanded="false"> <img width="25px" height="25px" src="/sys_files/img/profile_pic/user/{{$_SESSION['user_info']->profile_pic}}">
                                                                                                                                                                                                                                                                                           {{$_SESSION['user_info']->given_name}} <span class="caret"></span></a>
                               <ul class="dropdown-menu d" role="menu" style="background-color: #0076d7;">
                                             <li><a href="/OAMS/logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                                             <li><a href="{{route('athleteProfile')}}"><span class="glyphicon glyphicon-user"></span>My Profile</a></li>

                               </ul>
                             </li>
                  </ul>
            </nav>
            @yield('contents')
            </div>
           </div>
@yield('popup')
</body>
</html>