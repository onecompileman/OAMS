@extends('coach')
@section('css')
<style>

.confirm{
box-shadow: 0 0 5px rgba(0,0,0,0.6);
    position: absolute;
    z-index:20;
    width: 40%;
    left: 30%;
    display: none;
}
#modal{
    background-color: rgba(0,0,0,0.6);
   position:absolute;
    top: -5%;
    left: 0;
    z-index: 10;
    height: 340%;
    width: 115%;
    display: none;
    opacity: 0;
    transition: 1s linear;
    overflow-x: hidden;
}
#modal .s{
    width: 60%;
    position: relative;
    left: 15%;
}
.footer{
    	 background-color: #005599;
    	 position: relative;
    	 height: 50px;
    	 width: 100%;
    	 bottom: 0;
    	 left:0;
    	}
</style>
<script>
$(document).ready(function(){
 $('.menu').children('li').removeClass('active');
          document.getElementsByClassName('menu')[0].getElementsByTagName('li')[4].className='active';
        $.ajaxSetup({
       	headers: {
       		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       	        }
       });

    $('.view').click(function(){
            $('#modal').css('display','inline').animate({opacity:'1'},1000);
            $('#aID').val($(this).attr('id'));
            $.post("/OAMS/coach/Applicant/{{$page}}",{id:$(this).attr('id')},function(html){

                    $('.cons').html(html);
                }
            );
            });
            $('.close').click(function(){

                $('.confirm').css('display','none');
              $('#modal').animate({opacity:'0'},1000).css('display','none');
            });
            $('.accept').click(function(){
                $('.confirm').css('display','inline');
                $(document).scrollTop(0);
            })
    });
</script>
@stop
@section('contents')

<div class="confirm">
    <form method="post" action="{{route('updateApplicant')}}">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <center>   <h3>Confirm</h3></center>
            </div>
            <div class="panel-body">
                    <center><h4>Are You Sure?</h4></center>
             <input type="submit" class="btn btn-primary update" name="update" value="Confirm">
             <input type="hidden" value="" name="aID" id="aID">
             <input type="hidden" value="{{$page}}" name="page" >
             <div class="btn btn-warning close">cancel</div>

            </div>
        </div>
    </form>
</div>

<div id="modal">

    <div class="panel panel-primary s">
        <div class="panel-heading"><center><h3 style="color:white;">Applicant's Data</h3> <div class="btn btn-danger close">X</div></center></div>
        <div class="panel-body cons">

        </div>
        <div class="accept btn btn-primary">Accept</div>
    </div>
</div>
<div class="panel panel-primary">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="panel-heading"><center><h3 style="color:white;">Applicants</h3></center></div>
    <div class="panel-body">
           <table class="table table-bordered">
                <tr class="success"><th>Profile Picture</th><th>Name</th><th>Sports</th><th>Email</th><th>Home Address</th><th>View Profile</th></tr>
                @foreach($listOfApplicant as $applicant)
                    <tr>
                        <td><img width="40" height="40" src="/sys_files/img/profile_pic/applicant/{{$applicant->profile_pic}}"></td>
                        <td>{{$applicant->given_name}} {{$applicant->last_name}}</td>
                        <td>{{$applicant->sport}}</td>
                        <td>{{$applicant->email}}</td>
                        <td>{{$applicant->home_address}}</td>
                        <td><div class="btn btn-primary view" id="{{$applicant->id}}"><span class="glyphicon glyphicon-user"></span>View</div></td>
                    </tr>
                @endforeach
           </table>
           <div class="row">
           <center>
           @for($x=0;$x<(($no/8));$x++)
                <a href="/OAMS/coach/Applicant/{{$x+1}}"><div class="btn btn-primary" @if($page==$x+1)style="background-color: #005599;"@endif>{{$x+1}}</div></a>
           @endfor
           </center>
           </div>
           <div class="row well-sm">
           <center>
                <h4>{{$no}} of Applicant is in Pending</h4>
                </center>
           </div>
    </div>
</div>
@stop
