@extends('coach')
@section('css')
<style>
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
ul li{
color:red;
}
ul{
list-style: none;
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
	    $(document).ready(function(e){
	        $('#file').change(function(){
                $.post("{{route('profilepic')}}",{profile_pic:$(this).val()},function(html){
               // alert(html);
              //     $('#pic').attr('src',html);
                });
	        });
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
@stop
@section('contents')
<div class="panel panel-primary">
    <div class="panel-heading"><center><h3 style="color:white;"><span class="glyphicon glyphicon-edit"></span>My Profile</h3></center></div>
    <div class="panel-body">
        <form action="{{route('editProfile')}}" method="post" class="form-group" enctype="multipart/form-data">
            <div class="container-fluid">
          <div class="row">

              <div class="col-sm-3"> <label class="control-label" >Profile picture</label></div><div class="col-sm-5">

              </div>
            </div>

               <input type="hidden" name="MAX_FILE_SIZE" value="2500000">
               <div>
           <img id="pic" src="{{$_SESSION['user_info']->profile_pic}}" height="50" width="50">
            <input type="file" id="file" name="profile_pic">
            </div>
            <label class="control-label" >Username</label>

            <input class="form-control" type="text" name="username" value="{{$profile[0]->username}}">
            <label class="control-label" >Password</label>

            <input class="form-control" type="password" name="password">
            <label class="control-label" >Mac Addresses(seperate by coma(,))</label>

            <textarea class="form-control" name="Mac">{{$profile[0]->Mac}}
            </textarea>
            <br><br>
            <center>
            <input class="btn btn-primary" type="submit">
            </center>
            </div>
        </form>
         <ul class="error">
              @if(isset($Error))
               @foreach($Error as $err)
                <li>{{$err}}</li>
               @endforeach
               </ul>
               @endif
    </div>
</div>
@stop
@section('popup')
    @if(isset($Added))
       <center> <div class="success-message">
        <h3 class="success">{{$Added}}</h3>
        </div></center>
    @endif
@stop