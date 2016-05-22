<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>National University Athletics</title>

    <!-- Bootstrap core CSS -->
    <link href="/addons/css/bootstrap.css" rel="stylesheet">
    <link href="/addons/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href=/addons/css/main.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
 <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">
 <script src="/addons/js/jquery.js"></script>
 <script src="/addons/js/bootstrap.js"></script>
  <link rel="stylesheet" href="/addons/css/jasny-bootstrap.min.css" />
                 <link rel="stylesheet" href="/addons/css/jasny-bootstrap-responsive.min.css" />
     <script src="/addons/js/jasny-bootstrap.js"></script>
 @yield('addons')
 <style>
 body{
 background-color: rgb(230,230,230);
 overflow-x: hidden;
 }
    #f{
    background-color:#0b2644 ;
    padding-top: 2%;
    padding-bottom: 2%;
    }
        .navFixed{
            position: fixed;
            top: 0;
        }
       nav{
       z-index: 11;
         position:relative;
         width: 100%;
         background-color: #005599;
         padding-top: .2%;
         padding-bottom:1.2% ;
       }
       nav li a{
               color:#ffce42;

       }
    nav li{
        padding: 8px;
        font-size: 16px;
        position:relative;
        display: inline;
        top:15px;
        margin-left: 3%;
        margin-right: 4%;
        border-radius: 5px;
    }
    #r{
        background-color: rgba(34,207,246,0.6);
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
        .con{
        position:relative;
        width: 100%;
        box-shadow: 0px 0px 10px 10px rgba(0,0,0,0.6);
        }
        .sidebar{
        height: 400px;
        padding:1% ;
        width: 150%;
        box-shadow: 0 0 10px 10px rgba(0,0,0,0.6);
        }
        .content{
            overflow-x: hidden;
            overflow-y: scroll;
            height: 300px;
                }
                .side{
                    position: absolute;
                   margin-top: 80px;
                        }
        .header{
        background-color: #005599;
        width: 100%;
        padding-top: 3px;
        padding-bottom: 3px;
        color:#ffce42;
        text-align: center;
        margin-bottom: 10px;
        }
        .carousel-inner{
        width: 100%;
        height: 380px;
        }
        #footer{
        text-align: center;
        position: relative;
        margin-left: -2%;
        width: 110%;
        height: 15%;
        padding: 1%;
        float: bottom;
        }
.header2{
background-color: #005599;
    padding-top: 3px;
        padding-bottom: 3px;
        width: 50%;
          color:#ffce42;
                text-align: center;
                margin-bottom: 10px;
}
body::-webkit-scrollbar{
        width: 5px;
        background-color: #1b1b1b;
    }
    body::-webkit-scrollbar-thumb{
        background-color: #0080ff;
    }
 </style>
 <script>
             $('document').ready(function(){
                    $(window).scroll(function(){
                         if($(this).scrollTop()>=200){
                             $('#navigation').addClass('navFixed');
                         }
                         else if($(this).scrollTop()<=199){
                              $('#navigation').removeClass('navFixed');
                         }
                    });
             });
         </script>
</head>
<body>
   <div id="navigation" class="con">
  <div style="background-color: #0b2644;" class="navbar navbar-inverse navbar-fixed-top">
       <div class="container">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
         <a class="navbar-brand" ><div style="color:#30a5f5;position: relative;margin-top: -10px;"><span><img src="/addons/icons/nu.png" height="45" width="45">NATIONAL UNIVERSITY ATHLETICS</span><font style="color: #ffff00;"></font></div></a>

         </div>
         <div class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right">
               <li><a href="\"><span class="glyphicon glyphicon-home"></span>Home </a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-bookmark"></span>News</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-calendar"></span>Game Schedule</a></li>
                        <li><a href="{{route('about')}}"><span class="glyphicon glyphicon-question-sign"></span>About US</a></li>
                        <li><a href="{{route('contact')}}"><span class="glyphicon glyphicon-send"></span>Contact US</a></li>
                        <li><a href="{{route('apply')}}"><span class="glyphicon glyphicon-file"></span>Application</a></li>

              </ul>
         </div><!--/.nav-collapse -->
       </div>
     </div>


    <div class="container-fluid">
    <div class="row">
    @yield('contents')


<div id="r">
		<div class="container">
			<div class="row centered">
				<div class="col-lg-8 col-lg-offset-2" style="text-align: center;">
					<h3><b>NATIONAL UNIVERSITY ATHLETICS DEPARTMENT</b></h3>
					<p>National University is a strategic department of the university in creating, implementing and evaluating sports programs that develops athletes and varsity teams who will compete in the UAAP and other identified tournaments as determined by the school administration.

                       National University is engaged in UAAP Season 78 is the 2015–2016 athletic year of the University Athletic Association of the Philippines (UAAP). It opened on September 5, 2015, almost two months after the usual July opening of the league during previous seasons, due to the shift in the academic calendars of the member universities, including Ateneo, La Salle, UP and UST. It will be hosted by the University of the Philippines</p>
				</div>
			</div><!-- row -->
		</div><!-- container -->
	</div><! -- r wrap -->


	<!-- FOOTER -->
	<div id="f">
		<div class="container">
			<div class="row centered">
			<center>	<a href="#"><h2 style="display: inline;margin-right: 1.5%;"><i class="fa fa-twitter"></i></h2></a><a href="#"><h2 style="display: inline;margin-right: 1.5%;"><i class="fa fa-facebook"></i></h2></a><a href="#"><h2 style="display: inline;margin-right: 1.5%; "><i class="fa fa-dribbble"></i></h2></a></center>

			</div><!-- row -->
		</div><!-- container -->
	</div><!-- Footer -->



</div>
</div>
</div>
</body>
</html>