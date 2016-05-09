@extends('template')
        @section('addons')
        <style>
          .pp{
                            background-color:rgba(255,255,255,0.7);
                            box-shadow: 0 0 7px 7px rgba(0,0,0,0.4);
                            position: relative;
                            padding: 30px;
                        }
          .post div{
            text-align: right;
          }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.item:first-child').addClass('active');
            });
        </script>
        @stop
 @section('contents')
 <br/><br/> <br/>
    <div class="row">
    <center>
    <div class="col-sm-13">
    <div style="height: 480px;" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->

      <div class="carousel-inner" style="height: 480px;" role="listbox">
      @if(isset($carouselpics))
            @foreach($carouselpics as $car)
        <div class="item">
          <img   src="/sys_files/img/homescreen/carousel/{{$car->image}}" alt="..." height="480px" width="100%" >
          <div class="carousel-caption">
            ...
          </div>
        </div>
           @endforeach
            @endif

        ...
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </div>
    </center>
    </div>
<div class="container w">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-5">
                        <h2><b>P O S T S</b></h2>
                </div>
        </div>

		<div class="row centered">
			<br><br>
			@if(isset($blogCon))
			@foreach($blogCon as $blog)
			<div class="col-lg-3">
			     <img height="300px" width="100%" src="{{$blog->figure}}">
				<h2>{{$blog->title}}</h2>
				<p>  {{substr($blog->article,0,200)}}...</p>
				<a href="/blog/{{$blog->id  }}" class="btn btn-primary">Read More</a>
			</div><!-- col-lg-4 -->
			@endforeach
        @endif

		</div><!-- row -->
		<br>
		<br>
	</div><!-- container -->
    <hr style="border:1.5px #0b2644 solid;">

	<!-- PORTFOLIO SECTION -->
	<div id="dg">
		<div class="container">
			<div class="row centered">
				<center><h2><b>FACEBOOK FEEDS</b></h2></center>
				<br>
				<div class="col-lg-4">
					<div class="tilt">
					<a href="#"><img src="assets/img/p01.png" alt=""></a>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="tilt">
					<a href="#"><img src="assets/img/p03.png" alt=""></a>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="tilt">
					<a href="#"><img src="assets/img/p02.png" alt=""></a>
					</div>
				</div>
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- DG -->

        <hr style="border:1.5px #0b2644 solid;">

       	<!-- PORTFOLIO SECTION -->
       	<div id="dg">
       		<div class="container">
       			<div class="row centered">
       				<center><h2><b>N E W S</b></h2></center>
       				<br>
       				<div class="col-lg-4">
       					<div class="tilt">
       					<a href="#"><img src="assets/img/p01.png" alt=""></a>
       					</div>
       				</div>

       				<div class="col-lg-4">
       					<div class="tilt">
       					<a href="#"><img src="assets/img/p03.png" alt=""></a>
       					</div>
       				</div>

       				<div class="col-lg-4">
       					<div class="tilt">
       					<a href="#"><img src="assets/img/p02.png" alt=""></a>
       					</div>
       				</div>
       			</div><!-- row -->
       		</div><!-- container -->
       	</div><!-- DG -->
	<!-- FEATURE SECTION -->






	<!-- FOOTER -->

 @stop


